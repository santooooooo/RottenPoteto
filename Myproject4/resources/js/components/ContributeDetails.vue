<template>
	<div class="main">

		<div>

			<div class="info">
				<h2>{{detailInfo.contribute.title}}</h2>
				<p>ジャンル：{{detailInfo.contribute.genre}}</p>
				<div class="image">
					<img :src="'/storage' + detailInfo.contribute.picture.slice(6)" alt="picture">
				</div>
				<p>{{detailInfo.contribute.contents}}</p>
				<div class="point">
					<div class="satisfaction">
						<p>みんなの満足度：<span>{{detailInfo.contribute.satisfaction}}</span></p>
					</div>
					<div class="recommended">
						<p>みんなのオススメ度：<span>{{detailInfo.contribute.recommended}}</span></p>
					</div>
				</div>
			</div>

			<div v-for="review in detailInfo.reviews">
				<review-info :review="review"></review-info>
				<div class="inputGood">
					<form action="/good/push" method="post">
						<input type="hidden" name="google_user_id" :value="userInfo.id">
						<input type="hidden" name="user_review_id" :value="review.reviewId">
						<input type="submit" value="ポテトを送る">
					</form>
				</div>
				<div class="deleteGood">
					<form action="/good/delete" method="post">
						<input type="hidden" name="google_user_id" :value="userInfo.id">
						<input type="hidden" name="user_review_id" :value="review.reviewId">
						<input type="submit" value="取り消し">
					</form>
				</div>
			</div>

		</div>

		<div class="inputReview">
			<form action="/review/input" method="post">
				<input type="hidden" name="contribute_id" :value="detailInfo.contribute.id">
				<input type="hidden" name="google_user_id" :value="userInfo.id">
				<p>タイトル</p>
				<input type="text" name="title">
				<p>レビュー</p>
				<textarea name="review" rows="7" cols="50"></textarea>
				<p>ネタばれ</p>
				<input type="radio" name="spoiler" value="1">有り
				<input type="radio" name="spoiler" value="0">無し
				<p>満足度</p>
				<input type="number" name="satisfaction" min="0" max="5" step="1">
				<p>オススメ度</p>
				<input type="number" name="recommended" min="0" max="5" step="1">
				<input type="submit" value="レビューを送る">
			</form>
		</div>

		<div class="deleteReview">
			<form action="/review/delete" method="post">
				<input type="hidden" name="contribute_id" :value="detailInfo.contribute.id">
				<input type="hidden" name="google_user_id" :value="userInfo.id">
				<input type="submit" value="レビューを削除する">
			</form>
		</div>

	</div>
</template>

<style scoped>
.main {
	width: 95%;
	margin: 0 auto;
	padding: 20px 0;
}

.info {
	margin: 20px 0;
}
.info .image {
	margin: 50px 0;
	text-align: center;
}
.info .image img {
	width: 50%;
}

.point {
	display: flex;
	justify-content: right;
}
.point .satisfaction {
	width: 20%;
	margin: 10px 2%;
	padding: 3px;
	color: orange;
	border: solid orange 10px;
	border-radius: 20px;
	text-align: center;
}
.point .satisfaction p {
	color: orange;
}
.point .satisfaction p span {
	font-size: 40px;
}
.point .recommended {
	width: 20%;
	margin: 10px 2%;
	padding: 3px;
	color: green;
	border: solid green 10px;
	border-radius: 20px;
	text-align: center;
}
.point .recommended p {
	color: green;
}
.point .recommended p span {
	font-size: 40px;
}

</style>

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
