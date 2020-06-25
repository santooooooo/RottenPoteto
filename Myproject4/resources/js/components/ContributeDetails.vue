<template>
	<div>
		<div>
			<p>{{userInfo}}</p>
			<p>{{detailInfo}}</p>
		</div>

		<div>
			<form action="/review/input" method="post">
				<input type="hidden" name="contribute_id" :value="detailInfo.contribute.id">
				<input type="hidden" name="google_user_id" :value="userInfo.gmail">
				<input type="text" name="title">
				<textarea name="review" rows=""></textarea>
				<input type="number" name="satisfaction">
				<input type="number" name="recommended">
				<input type="submit" value="レビューを送る">
			</form>
		</div>
	</div>
</template>

<script>
export default {
	data: function()
	{
		return {
			detailInfo: [],
		}
	},
	props:
	{
	    userInfo: {
		    type: Object,
		    required: false,
	    }
	},
	mounted: function()
		{
			axios.get('/review-page?contribute_id=' + this.$route.params.contributeId)
				.then(response => this.detailInfo = response.data);
		},
}
</script>
