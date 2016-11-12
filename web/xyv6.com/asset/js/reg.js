$(function(){
		//声明所有的电子邮件变量
		var mail=new Array("qq.com","126.com","163.com","gmail.com","hotmail.com","foxmail.com","icloud.com","sina.com","outlook.com","bjtu.edu.cn","bupt.edu.cn","bit.edu.cn","fudan.edu.cn","tju.edu.cn");
		//生成一个个li，并加入到ul中
		for(var i=0;i<mail.length;i++){
			var liElement=$("<li class=\"autoli\"><span class=\"ex\"></span><span class=\"at\">@</span><span class=\"tail\">"+mail[i]+"</span></li>");
			liElement.appendTo("ul.list");
		}
		//首先让list隐藏起来
		$("ul.list").hide();

		$("#email").keyup(function(event){
			//键入的内容不是上下箭头和回车
			if(event.keyCode!=38&&event.keyCode!=40&&event.keyCode!=13){
				//如果输入的值不是空或者不以空格开头
				if($.trim($(this).val())!=""&& $.trim($(this).val()).match(/^@/)==null){
					$("ul.list").show();
					//如果当前有已经高亮的下拉选项卡，那么将其移除
					if($("ul.list li:visible").hasClass("lilight")){
						$("ul.list li").removeClass("lilight");
					}
					//如果还存在下拉选项卡，那么将其高亮
					if($("ul.list li:visible")){
						$("ul.list li:visible:eq(0)").addClass("lilight");
					}
				}else{
				//否则不进行显示
					$("ul.list").hide();
					$("ul.list li").removeClass("lilight");
				}
				//输入的内容还没有包括@符号
				if($.trim($(this).val()).match(/.*@/)==null){
					$(".list li .ex").text($(this).val());
				}else{
				//输入的符号已经包含了@
					var str = $(this).val();
					var strs = str.split("@");
					$(".list li .ex").text(strs[0]);
					if($(this).val().length>=strs[0].length+1){
						tail=str.substr(strs[0].length+1);
						$(".list li .tail").each(function(){
							//如果数组中的元素是以文本中的后缀开头，那么就显示，否则不显示
							if(!($(this).text().match(tail)!=null&&$(this).text().indexOf(tail)==0)){
								//隐藏其他的li
								$(this).parent().hide();
							}else{
								//显示所在的li
								$(this).parent().show();
							}
						});
					}
				}
			}
			//按了回车时，将当前选中的元素写入到文本框中
			if(event.keyCode==13){
				$("#email").val($("ul.list li.lilight:visible").text());
				$("ul.list").hide();
			}
		});

		//监听上下方向键
		$("#email").keydown(function(event){
			//下方向键按下了
			if(event.keyCode==40){
				if($("ul.list li").is(".lilight")){
					if($("ul.list li.lilight").nextAll().is("li:visible")){
						$("ul.list li.lilight").removeClass("lilight").next("li").addClass("lilight");
					}
				}
			}
			//下方向键按下了
			if(event.keyCode==38){
				if($("ul.list li").is(".lilight")){
					if($("ul.list li.lilight").prevAll().is("li:visible")){
						$("ul.list li.lilight").removeClass("lilight").prev("li").addClass("lilight");
					}
				}
			}
		});

		//当鼠标点击某个下拉项时，选中该项，下拉列表隐藏
		$("ul.list li").click(function(){
			$("#email").val($(this).text());
			$("ul.list").hide();
		});

		//当鼠标划过某个下拉项时，选中该项，下拉列表隐藏
		$("ul.list li").hover(function(){
			$("ul.list li").removeClass("lilight");
			$(this).addClass("lilight");
		});

		//当鼠标点击其他位置，下拉列表隐藏
		$(document).click(function(){
			$("ul.list").hide();
		});
	});


      function refreshCaptcha(){
          var img = document.images['captchaimg'];
          img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
      }
      $(function () {
          $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
          });
      });

      $(document).ready(function(){
           function register(){
              $.ajax({
                  type:"POST",
                  url:"_reg.php",
                  dataType:"json",
                  data:{
                      email: $("#email").val(),
                      name: $("#name").val(),
                      captcha_code: $("#captcha_code").val()
                  },
                  success:function(data){
                      if(data.ok){
                      	layer.alert("注册成功，"+data.msg, {icon: 6},
											function(index){
												window.setTimeout("location.href='login.php'");
											});
                      }else{
                      	layer.msg(data.msg, {icon: 5,time: 2000});
                      }
                  },
                  error:function(jqXHR){
                    layer.msg("发生错误："+jqXHR.status, {icon: 5,time: 1500});
                  }
              });
          }
          $("html").keydown(function(event){
              if(event.keyCode==13){
                  register();
              }
          });
          $("#reg").click(function(){
              layer.confirm("确定同意我们的服务条款吗？", {
                  title: "确定？",
                  btn: ['同意并注册','不同意并关闭'], //按钮
                  skin: 'layui-layer-lan'
                  ,closeBtn: 0
                  ,shift: 5 //动画类型
                  },
                  function(){
                      register();
                  },
                  function(){
                      window.close();
                  });

          });
      })
