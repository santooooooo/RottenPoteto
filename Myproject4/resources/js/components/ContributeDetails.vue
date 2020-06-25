<template>
	<div>
		<div>
			<p>{{userInfo}}</p>
			<p>{{detailInfo}}</p>
		</div>

		<div>
			<form action="/review/input" method="post">
				<input type="hidden" name="contribute_id" :value="detailInfo.contribute.id">
				<input type="hidden" name="google_user_id" :value="userInfo.id">
				<p>タイトル</p>
				<input type="text" name="title">
				<p>レビュー</p>
				<textarea name="review" rows="7" cols="50"></textarea>
				<p>ネタばれ</p>
				<input type="radio" name="spoiler" value="0">有り
				<input type="radio" name="spoiler" value="1">無し
				<p>満足度</p>
				<input type="number" name="satisfaction" min="0" max="5" step="1">
				<p>オススメ度</p>
				<input type="number" name="recommended" min="0" max="5" step="1">
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
