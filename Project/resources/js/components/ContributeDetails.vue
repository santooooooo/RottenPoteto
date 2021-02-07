<template>
	<div class="main">

		<div class="detail">

			<div class="info">
				<h1>{{detailInfo.contribute.title}}</h1>
				<p>ジャンル：{{detailInfo.contribute.genre}}</p>
				<div class="image">
					<img :src="'/storage' + detailInfo.contribute.picture.slice(6)" alt="picture">
				</div>
				<p>{{detailInfo.contribute.contents}}</p>
				<div class="point">
					<div class="satisfaction">
						<p>みんなの満足度</p>
						<p><span>{{detailInfo.contribute.satisfaction}}</span>/5</p>
					</div>
					<div class="recommended">
						<p>みんなのオススメ度</p>
						<p><span>{{detailInfo.contribute.recommended}}</span>/5</p>
					</div>
				</div>
			</div>

		</div>

		<div v-if="isUser" class="openButton">
			<p class="reviewButton" v-if="!reviewStatus" @click="openReview">レビューをする</p>
		</div>
		<div v-if="isUser && reviewStatus" class="input-review">
			<h2>レビューホーム</h2>
			<form>
				<p>タイトル<span>※必須(255文字以下)</span></p>
				<input type="text" v-model="title" size="100" maxlength="255" required class="input">
				<p>レビュー<span>※必須(3000文字以下)</span></p>
				<textarea v-model="reviewContents" rows="20" cols="105" maxlength="3000" required class="input">
				</textarea>
				<div class="input-button">
					<div class="input-spoiler">
						<p>ネタばれ<span>※必須</span></p>
						<input type="radio" v-model="spoiler" value="1" required>有り
						<input type="radio" v-model="spoiler" value="0" required>無し
					</div>
					<div class="input-satisfaction">
						<p>満足度<span>※必須 ０～５点</span></p>
						<input type="number" v-model="satisfaction" min="0" max="5" step="1" required>					
					</div>
					<div class="input-recommended">
						<p>オススメ度<span>※必須 ０～５点</span></p>
						<input type="number" v-model="recommended" min="0" max="5" step="1" required>
					</div>
					<input @click="pushReview" class="submit" type="submit" value="レビューを送る">
				</div>
			</form>
			<p class="reviewButton" @click="closeReview">レビューをやめる</p>
		</div>

		<div v-if="isUser" class="delete-review">
			<input @click="deleteReview" type="submit" value="自分のレビューを削除する">
		</div>

		<div class="review-title">
			<h2>みんなのレビュー</h2>
		</div>

		<div v-for="review in detailInfo.reviews">
			<review-info :review="review" :user-info="userInfo" :csrf-token="csrfToken"></review-info>
		</div>

	</div>
</template>

<style scoped>
.main {
	width: 95%;
	margin: 0 auto;
	padding: 20px 0;
}

.detail {
	margin: 0 0 100px 0;
}

.info {
	margin: 20px 0 80px 0;
}
.info {
	text-align: left;
}
.info h1 {
	text-align: left;
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
.satisfaction {
	width: 20%;
	margin: 10px 2%;
	padding: 3px;
	color: orange;
	border: solid orange 7px;
	border-radius: 20px;
	text-align: center;
}
.satisfaction p {
	color: orange;
}
.satisfaction p span {
	font-size: 40px;
}
.recommended {
	width: 20%;
	margin: 10px 2%;
	padding: 3px;
	color: green;
	border: solid green 7px;
	border-radius: 20px;
	text-align: center;
}
.recommended p {
	color: green;
}
.recommended p span {
	font-size: 40px;
}
@media screen and (max-width:480px) {
	.point {
		display: flex;
		justify-content: center;
	}
	.satisfaction {
		width: 40%;
	}
	.recommended {
		width: 47%;
	}
}

.openButton {
	margin: 0 0 0 5%;
}
.reviewButton {
	width: 15%;
	color: white;
	background-color: black;
	border: solid white 2px;
	border-radius: 10px;
}
.reviewButton:hover {
	color: black;
	background-color: white;
}

.review-title {
	text-align: center;
}

.input-review {
	width: 90%;
	margin: 0 auto;
	border: solid white 5px;
	border-radius: 10px;
}
.input-review form {
	padding: 20px;
}
.input-review span {
	color: red;
}
.input-review .input {
	width: 90%;
}
.input-button {
	display: flex;
	justify-content: left;
}
@media screen and (max-width:480px) {
	.reviewButton {
		width: 40%;
	}

	.input-review {
			width: 90%;
			margin: 0 auto;
	}
	.input-button {
		display: unset;
	}
}

.input-spoiler {
	color: white;
	margin: 10px 20px 0 0;
}

.input-satisfaction , .input-recommended {
	margin: 10px 20px 0 0;
}
.input-satisfaction input , .input-recommended input {
	color: black;
}

.submit {
	color: white;
	background-color: black;
	border: solid white 3px;
	border-radius: 10px;
	margin: 10px 0 0 0;
}
.submit:hover {
	color: black;
	background-color: white;
}

.delete-review {
	margin: 20px 0 20px 5%;
	width: 90%;
}
.delete-review input {
	color: red;
	border: solid red 3px;
	border-radius: 10px;
	background-color: black;
}
.delete-review input:hover {
	color: black;
	background-color: red;
}

</style>

<script>
import ReviewInfo from './ReviewInfo';

export default {
	data: function()
	{
		return {
			detailInfo: [],
			review: false,
			title: '',
			reviewContents: '',
			spoiler: null,
			satisfaction: 0,
			recommended: 0 
		}
	},
	props:
	{
	    userInfo: {
		    type: Object,
		    required: false,
	    },
	    csrfToken: {
		    type: String,
		    required: false,
	    }
	},
	components:
	{
		'review-info': ReviewInfo,
	},
	computed: {
    isUser: function() {
	    if(this.userInfo.length != 0)
	    {
		    return true;
	    }
	    return false;
    },
		reviewStatus: function() {
			if(this.review == true)
			{
				return true;
			}
			return false;
		}
	},
	mounted: function()
		{
			axios.get('/review-page?contribute_id=' + this.$route.params.contributeId)
				.then(response => this.detailInfo = response.data);
		},
	methods: {
		openReview: function()
		{
			return this.review = true;
		},
		closeReview: function()
		{
			return this.review = false;
		},
		pushReview: function()
		{
			if(this.title == "" | this.title.length > 255 | this.reviewContents == "" | this.reviewContents.length > 3000 | this.spoiler == null | 
				this.satisfaction < 0 | this.recommended < 0 | this.satisfaction > 5 | this.recommended > 5)
			{
				alert("レビューの内容に空白または想定外の値が含まれています。もう一度入力してください。")
				return
			}
			const check = window.confirm("レビューを投稿してもよろしいですか？")
			if(check)
			{
				axios({
					method: 'post',
					url: '/review/input',
					data: {
						contribute_id: this.detailInfo.contribute.id,
						google_user_id: this.userInfo.id,
						title: this.title,
						review: this.reviewContents,
						spoiler: this.spoiler,
						satisfaction: this.satisfaction,
						recommended: this.recommended,
					},
					headers: {
						'X-CSRF-TOKEN': this.csrfToken
					},
				}).then(function(response)
					{
						if(response.data)
						{
							alert('レビューの投稿に成功しました。')
							location.reload()
							return
						}
						alert('その映画に対するレビューは既に存在しています。')
					})
				return
			}
			return
		},
		deleteReview: function()
		{
			const check = window.confirm("本当に自分のレビューを削除しますか？")
			if(check)
			{
				axios({
					method: 'post',
					url: '/review/delete',
					data: {
						contribute_id: this.detailInfo.contribute.id,
						google_user_id: this.userInfo.id
					},
					headers: {
						'X-CSRF-TOKEN': this.csrfToken
					}
				}).then(function(response)
					{
						if(response.data)
						{
							alert('レビューの削除に成功しました。')
							location.reload()
							return
						}
						alert('その映画に対するレビューは既に削除されています。')
					})
			}
		}
	},
}
</script>
