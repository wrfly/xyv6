# Servers www.xyv6.com

server {
    listen 80;
    listen [::]:80;
    server_name xyv6.com www.xyv6.com;
    
    # rewrite ^/(.*) https://www.xyv6.com/$1 permanent;
	
	root /var/www/xyv6;
    rewrite /wp-admin$ $scheme://$host$uri/ permanent;

	index index.php index.html index.htm;
    location / {
         try_files $uri $uri/ /index.php?$args;
	}

    error_page 403 /var/www/xyv6/;
    error_page 404 /var/www/xyv6/;
    error_page 500 /var/www/xyv6/;

    location ~ .php$ {
		fastcgi_pass unix:/var/run/php5-fpm.sock;
	    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	 	fastcgi_index index.php;
	 	include fastcgi_params;
	 	try_files $uri $uri/ /;
	 }

    location ~ \.(gif|jpg|jpeg|png|bmp|swf)$ {
        expires      3650d;
        access_log off;
    }
    
    location ~ \.(js|css)?$ {
        expires      30d;
        access_log off;
    }
    
    location /user/ {
            try_files $uri $uri.html $uri/ @extensionless-php;
                index index.html index.htm index.php;
    }

    location ~ \.php$ {
            try_files $uri =404;
    }

    location @extensionless-php {
            rewrite ^(.*)$ $1.php last;
    }
}

server {
	listen 443;
	listen [::]:443;

	server_name www.xyv6.com xyv6.com;

    root /var/www/xyv6;
    rewrite /wp-admin$ $scheme://$host$uri/ permanent;

	# Add index.php to the list if you are using PHP
	index index.php index.html index.htm;


    ssl on;
    ssl_certificate /etc/ssl/private/xyv6.crt;
    ssl_certificate_key /etc/ssl/private/xyv6.com.key;
    ssl_session_timeout 5m;
    ssl_protocols SSLv3 TLSv1 TLSv1.1 TLSv1.2;
    ssl_ciphers "HIGH:!aNULL:!MD5 or HIGH:!aNULL:!MD5:!3DES";
    ssl_prefer_server_ciphers on;

	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
        try_files $uri $uri/ /index.php?$args;
	}

    error_page 403 /var/www/xyv6/;
    error_page 404 /var/www/xyv6/;
    error_page 500 /var/www/xyv6/;

	# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	#
	location ~ .php$ {
	#	# With php5-fpm:
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
		fastcgi_index index.php;
		include fastcgi_params;
		try_files $uri $uri/ /;
	}

	# deny access to .htaccess files, if Apache's document root
	# concurs with nginx's one
	#
	#location ~ \.bak$ {
	#	deny all;
	#}
    location /user {
            try_files $uri $uri.html $uri/ @extensionless-php;
            index index.html index.htm index.php;
    }

    location ~ \.php$ {
            try_files $uri =404;
    }

    location @extensionless-php {
            rewrite ^(.*)$ $1.php last;
    }
    location /downloads {
        root /var/www/donwloads;
    }

    location ~ \.(gif|jpg|jpeg|png|bmp|swf)$ {
        expires      3650d;
        access_log off;
    }
    location ~ \.(js|css)?$ {
        expires      30d;
        access_log off;
    }
}