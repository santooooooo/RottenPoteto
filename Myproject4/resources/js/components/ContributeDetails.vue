<template>
	<div>

		<div>

			<div>

				<p>{{detailInfo.contribute.title}}</p>
				<p>{{detailInfo.contribute.contents}}</p>
				<img :src="'/storage' + detailInfo.contribute.picture.slice(6)" alt="picture">
				<p>{{detailInfo.contribute.genre}}</p>
				<p>{{detailInfo.contribute.satisfaction}}</p>
				<p>{{detailInfo.contribute.recommended}}</p>
			</div>

			<div v-for="review in detailInfo.reviews">
				<review-info :review="review"></review-info>

				<div>
					<form action="/good/push" method="post">
						<input type="hidden" name="google_user_id" :value="userInfo.id">
						<input type="hidden" name="user_review_id" :value="review.reviewId">
						<input type="submit" value="ポテトを送る">
					</form>
					<form action="/good/delete" method="post">
						<input type="hidden" name="google_user_id" :value="userInfo.id">
						<input type="hidden" name="user_review_id" :value="review.reviewId">
						<input type="submit" value="取り消し">
					</form>
				</div>

			</div>

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

		<div>
			<form action="/review/delete" method="post">
				<input type="hidden" name="contribute_id" :value="detailInfo.contribute.id">
				<input type="hidden" name="google_user_id" :value="userInfo.id">
				<input type="submit" value="レビューを削除する">
			</form>
		</div>

	</div>
</template>

<script>
import ReviewInfo from './ReviewInfo';

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
	components:
	{
		'review-info': ReviewInfo,
	},
	mounted: function()
		{
			axios.get('/review-page?contribute_id=' + this.$route.params.contributeId)
				.then(response => this.detailInfo = response.data);
		},
}
</script>
