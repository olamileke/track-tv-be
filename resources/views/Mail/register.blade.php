<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Raleway');
			@import url('https://fonts.googleapis.com/css?family=Quicksand');

			div.container
			{
				position:absolute;
				top:10vh;
				left:5vw;
				width:90vw;
				padding:2vh 0 5vh 0;
				display: flex;
				flex-flow: column;
				align-items: center;
				background:rgba(0,0,0,0.06);
				margin-bottom:10vh;
			}

			div.main
			{
				position:relative;
				margin-top:3%;
				width:70vw;
				background:#fff;
				display: flex;
				flex-flow:column;
				align-items: center;
				/*justify-content: center;*/
				padding:6% 4% 10% 4%;
				font-family:'', sans-serif;
				box-sizing: border-box;
			}

			div.main img
			{
				border-radius: 50%;
			}

			p
			{
				margin:0;
				font-family: 'Raleway', sans-serif;
			}

			div.main p.header
			{
				font-size:1.35em;
				color:#63C28D;
				margin:20px 0 30px 0;
			}

			div.main p.content
			{
				line-height:1.7	;
				color:rgba(0,0,0,0.7);
				width:80%;
				margin-bottom:20px;
				text-align: center;
			}

			div.activate
			{
				font-family: 'Quicksand', sans-serif;
				color:rgba(0,0,0,0.7);
				width:80%;
				display: flex;
				flex-flow:column;
				align-items: center;
			}

			div.activate a
			{				
				margin-top:30px;
				text-decoration:none;
				padding:10px 6px;
				border-radius:4px;
				background:orange;
				box-shadow:0 5px 10px rgba(0,0,0,0.3);
				color:#fff;
				width:40%;
				text-align: center;
			}

			div.footer
			{
				margin-top:20px;
				text-align: center;
			}

			div.footer a
			{
				text-decoration:none;
				color:rgba(0,0,0,0.4);
				font-family:'Raleway', sans-serif;
				font-size:1.3em;
			}

			div.footer p
			{
				margin-top:15px;
				color:rgba(0,0,0,0.4);
			}

		</style>
	</head>
	<body>

		<div class='container'>
			
			<div class='main'>

				<p class='header'>Activate Your Account</p>

				<p class='content'>Hey <b>{{ $user->name }}</b>, welcome to TrackTv. Just one more step to 
				 complete your account setup
				</p>

				<div class='activate'>
					Click this link to activate your account

					<a href="http://localhost:4200/account/activate/{{$token}}">Activate</a>
				</div>		
				
			</div>

			<div class='footer'>
				<a href="localhost:4200">TrackTv</a>
				<p>Stay up to date with your favourties Tv Series</p>
			</div>

		</div>
	</body>
</html>