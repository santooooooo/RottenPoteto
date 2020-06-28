<template>
	<div>
		<form action="/update" method="post" enctype="multipart/form-data">
			<input type="hidden" name="gmail" :value="userInfo.gmail">
			<P>アカウント名</P>
			<input type="text" name="name" :value="userInfo.name">
			<P>プロフィール</P>
			<textarea name="profile" rows="6" cols="30" :value="userInfo.profile"></textarea>
			<P>アイコン</P>
			<img :src="userPicture" alt="picture">
			<input type="file" name="icon">
			<P>好きな映画</P>
			<input type="text" name="best" :value="userInfo.best">
			<input type="submit" value="アカウント情報更新">
		</form>
	</div>
</template>

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
