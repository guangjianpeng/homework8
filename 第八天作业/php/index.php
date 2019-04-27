<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx4bc51c2f896f65eb", "0430130fab18ed36fe46f5dbf9688292");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
  <title></title>
  <link rel="stylesheet" href="css/weui.css" />
  
  <style type="text/css">
  	
  		body{
  			background-color: #EEF1F6;
  			 padding: 10px 15px;
  			
  		}
  		
  		body button{
  			margin-bottom: 20px;
  		}
  	  
  	  .weui-article p{
  	  	border: 1px solid #999999;
  	  	height: 20%;
  	   
  	  }
  	  
  </style>
</head>
<body>
	  <div class="weui-cells">

			<a class="weui-cell weui-cell_access" href="javascript:;">
				<div class="weui-cell__bd">
					<p style="color: #999999;">接收人</p>
				</div>
				<div class="weui-cell__ft">初三数学集体冲刺五班6名学生</div>
			</a>
			
		</div>
		
		<div class="weui-cells">
			<div class="weui-cell">
				<div class="weui-cell__bd">
					<p style="color: #999999;">标题文字</p>
				</div>
				<div class="weui-cell__ft">5.9日随堂测试</div>
			</div>
		</div>
		
		<div class="continer"style="background-color: white;margin-top: 10%;margin-bottom: 20%;">
			<article class="weui-article">
				<section>
					<section>
						<h3>内容</h3>
						<p style="font-size: 25px;">
							请同学完成以下试卷，并于明天上午上课前提交给老师。
						</p>
						
					</section>
					
			</article>
       <img src="" alt="" id="image" style="width: 100%;" />
	
	   <button id="startRecord" class="weui-btn weui-btn_primary">点击录制语音</button>
	   
	   <button id="uploadImage" class="weui-btn weui-btn_primary" style="margin-bottom: 10%;">上传相关图片</button>
	   
      

 
		</div>
			<button class="weui-btn weui-btn_primary" style="background-color: 1E88F5;bottom: 0px;">提交</button>
		
		
		
		
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  
  var localId = null;
  var serverId = null;
  
  var latitude = 0; // 纬度，浮点数，范围为90 ~ -90
	var longitude = 0; // 经度，浮点数，范围为180 ~ -180。
	var speed = 0; // 速度，以米/每秒计
	var accuracy = 0; // 位置精度
  
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ["uploadImage","startRecord"]
  });               
  wx.ready(function () {
    console.log("ready OK")
    
     
    
    // 录音时间超过一分钟没有停止的时候会执行 complete 回调
    wx.onVoiceRecordEnd({
				complete: function (res) {
				localId = res.localId;
				}
			});
			
			// 播放录音自动停止
			wx.onVoicePlayEnd({
					success: function (res) {
							localId = res.localId; // 返回音频的本地ID
					}
			});
    
  });
  
  
  wx.error(function(res){
    console.log(res)
	});
	
		
		document.querySelector("#uploadImage").onclick = function(){
				wx.uploadImage({
						localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
						isShowProgressTips: 1, // 默认为1，显示进度提示
						success: function (res) {
								serverId = res.serverId; // 返回图片的服务器端ID
						}
				});
		}
	
</script>
</html>
