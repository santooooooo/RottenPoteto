<template>
	<div>
		<router-link :to="{ path: '/user/' + review.userId }">
			<p>{{review.userName}}</p>
		</router-link>
		<img :src="userPicture" alt="picture">
		<p>{{review.title}}</p>
		<p>{{review.review}}</p>
		<p>{{review.spoiler}}</p>
		<p>満足度</p>
		<p>{{review.satisfaction}}</p>
		<p>オススメ度</p>
		<p>{{review.recommended}}</p>
		<p>ポテト</p>
		<p>{{review.goodPoint}}</p>
	</div>
</template>

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
