<template>
	<div>
		<p>ユーザー情報</p>
		<div>
			<p>{{userInfo.name}}</p>
			<p>{{userInfo.profile}}</p>
			<img :src="'/storage' + userInfo.icon.slice(6)">
			<p>{{userInfo.best}}</p>
		</div>
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
	mounted: function()
		{
			axios.get('/review-page/user?google_user_id=' + this.$route.params.userId)
				.then(response => this.userInfo = response.data);
		},
}
</script>
