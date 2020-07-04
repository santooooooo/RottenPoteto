<template>
	<div class="main">
		<img :src="userPicture">
		<div class="info">
			<div>
				<p>レビュワーネーム</p>
				<p>{{userInfo.name}}</p>			
			</div>
			<div>
				<p>プロフィール</p>
				<p>{{userInfo.profile}}</p>			
			</div>
			<div>
				<p>好きな映画</p>
				<p>{{userInfo.best}}</p>			
			</div>
		</div>
	</div>
</template>

<style scoped>

.main {
	width: 90%;
	margin: 0 auto;
	display: flex;
	justify-content: left;
}
.main img {
	width: 40%;
	margin: 50px 20px 0 0;
	border-radius: 20px;
}
@media screen and (max-width:480px) {
	.main img {
		width: 50%;
		height: 200px;
		margin: 100px 20px 0 0;
	}
}

.info {
	margin: 50px 0 0 20px;
}
.info div {
	margin: 40px 0;
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
			axios.get('/review-page/user?google_user_id=' + this.$route.params.userId)
				.then(response => this.userInfo = response.data);
		},
}
</script>
