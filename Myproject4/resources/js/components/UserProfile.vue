<template>
	<div class="main">
		<form action="/update" method="post" enctype="multipart/form-data">
			<input type="hidden" name="gmail" :value="userInfo.gmail">
			<P>アカウント名</P>
			<input type="text" name="name" :value="userInfo.name" maxlength="255" required>
			<P>プロフィール</P>
			<textarea name="profile" rows="3" cols="100" :value="userInfo.profile" maxlength="1000">
			</textarea>
			<P>アイコン</P>
			<div class="icon">
				<img :src="userPicture" alt="picture">
				<input type="file" name="icon" class="button" accept="image/*">
			</div>
			<P>好きな映画</P>
			<input type="text" name="best" :value="userInfo.best" maxlength="255">
			<input type="submit" value="アカウント情報更新" class="button">
		</form>
	</div>
</template>

<style scoped>

.main {
	width: 90%;
	margin: 0 auto;
}
.main p {
	margin: 30px 0 0 0;
}

.icon {
	display: flex;
	justify-content: left;
}
.icon img {
	width: 40%;
	border-radius: 20px;
	margin: 0 5% 0 0;
}
.icon input {
	margin: 450px 0 0 0;
}

.button {
	margin: 0 0 0 2%;
	color: white;
	background-color: black;
	border: solid white 2px;
	border-radius: 10px;
}
.button:hover {
	color: black;
	background-color: white;
}

</style>

<script>
export default {
  data: function()
	{
		return {
			userInfo: [],
		}
	},
	computed: {
		userPicture: function()
		{
			if(this.userInfo.icon == null)
			{
				return '/storage/home/userPotatoImage';
			}
			return '/storage' + this.userInfo.icon.slice(6);
		}
	},
	mounted: function()
		{
			axios.get('/user-info?google_user_gmail=' + this.$route.params.userGmail)
				.then(response => this.userInfo = response.data);
		},
}
</script>
