<template>
	<div>
		<p>ユーザー情報</p>
		{{userInfo}}
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
