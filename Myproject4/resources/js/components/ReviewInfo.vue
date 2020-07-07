<template>
	<div class="main">
		<div class="review-top">
			<router-link :to="{ path: '/user/' + review.userId }">
				<img :src="userPicture" alt="picture">
			</router-link>		
			<div class="info">
				<router-link :to="{ path: '/user/' + review.userId }">
					{{review.userName}}
				</router-link>
				<div class="point">
					<p>満足度：{{review.satisfaction}}</p>
					<p>オススメ度：{{review.recommended}}</p>
					<p><img src="storage/home/potatoIcon"> × {{review.goodPoint}}</p>
				</div>
			</div>
		</div>
		<div class="review-bottom">
			<p class="title">{{review.title}}</p>
			<p class="spoiler">{{review.spoiler}}</p>
			<p v-if="!reviewInfo" @click="showReview">レビューを読む</p>
			<p v-if="reviewInfo">{{review.review}}</p>
			<p v-if="reviewInfo" @click="deleteReview">レビューを閉じる</p>
		</div>
	</div>
</template>

<style scoped>
.main {
	width: 80%;
	margin: 0 auto;
}
.review-top {
	display: flex;
	justify-content: left;
	margin: 0 0 10px 0;
}
.review-top img {
	width: 100px;
	height: 100px;
	border-radius: 10px;
}

.info {
	width: 80%;
	margin: 0 0 0 3%;
}

.point {
	display: flex;
	justify-content: left;
	margin: 20px 0 0 0;
}
.point p {
	margin: 0 5px;
	width: 10%;
}
.point img {
	width: 30px;
	height: 30px;
	margin: 0 0 0 2px;
}

@media screen and (max-width:480px) {
	.review-top img {
		margin: 0 20px 0 0;
	}

	.point {
		display: unset;
		justify-content: left;
	}
	.point p {
		margin: 0 5px;
		width: 100%;
	}
}

.title {
	font-weight: bold;
}
.spoiler {
	color: red;
	font-weight: bold;
}

</style>

<script>
export default {
	props: {
		review: {
			type: Object,
			required: false
		}
	},
	data: function() {
		return {
			show: false,
		}
	},
	computed: {
		userPicture: function()
		{
			if(this.review.userIcon == null)
			{
				return '/storage/home/userPotatoImage';
			}
			return '/storage' + this.review.userIcon.slice(6);
		},
		reviewInfo: function()
		{
			if(this.show)
			{
				return true;
			}
			return false;
		}
	},
	methods: {
		showReview: function()
		{
			return this.show = true;
		},
		deleteReview: function()
		{
			return this.show = false;
		}
	},
}
</script>
