<template>
	<div class="main">
		<img :src="userPicture" alt="picture">
		<div class="info">
			<router-link :to="{ path: '/user/' + review.userId }">
				{{review.userName}}
			</router-link>
			<p class="spoiler">{{review.spoiler}}</p>
			<p>{{review.title}}</p>
			<p>{{review.review}}</p>
			<div class="point">
				<p>満足度：{{review.satisfaction}}</p>
				<p>オススメ度：{{review.recommended}}</p>
				<p><img src="storage/home/potatoIcon"> × {{review.goodPoint}}</p>
			</div>
		</div>
	</div>
</template>

<style scoped>
.main {
	width: 60%;
	margin: 0 auto;
	display: flex;
	justify-content: space-around;
}
.main img {
	width: 100px;
	height: 100px;
}

.info {
	width: 80%;
}
.info .spoiler {
	color: red;
	font-weight: 500;
}

.point {
	display: flex;
	justify-content: left;
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
</style>

<script>
export default {
	props: {
		review: {
			type: Object,
			required: false
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
		}
	},
}
</script>
