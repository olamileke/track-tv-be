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
				padding:2% 2% 10% 2%;
				font-family:'', sans-serif;
				box-sizing: border-box;
				font-family:'Raleway';
				color:rgba(0,0,0,0.75);
			}

			div.main img
			{
				width:100%;
				height:350px;
				object-fit: cover;
				margin-bottom:0px;
			}

			div.main div
			{
				width:60%;
				display:flex;
				flex-flow:column;
				align-items: center;
				/*text-align:center;*/
			}

			div.main div p
			{
				margin:-3px 0 8px 0;
				text-align: center;
			}

			div.main span
			{
				margin-bottom:8px;
				text-align: center;
				lin-height:1.6;
				font-family:'Quicksand',sans-serif;
				color:rgba(0,0,0,0.68);
				font-size:0.95em;

			}

			div.footer
			{
				margin-top:20px;
				text-align: center;
				font-family:'Raleway', sans-serif;
			}

			div.footer a
			{
				text-decoration:none;
				color:rgba(0,0,0,0.4);
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

				<img src="{{ $show->imagepath }}">	

				<p>
					Hey {{ $user->getLastName() }}, a new episode of {{ $show->name }} was released yesterday			
				</p>	

				<div>
					<p><b>Negative Man Energy</b></p>
					<span>Season {{ $show->next_episode_season }} Episode {{ $show->next_episode_number }}</span>
					<span>"{{ $show->about_episode }}"</span>
					<span>{{ $show->getFormattedDate() }}</span>
				</div>						
			</div>

			<div class='footer'>
				<a href="localhost:4200">TrackTv</a>
				<p>Stay up to date with your favourite Tv Series</p>
			</div>

		</div>
	</body>
</html>