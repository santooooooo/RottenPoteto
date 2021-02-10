<template>
	<div class="main">
		<form enctype="multipart/form-data">
			<input type="hidden" v-model="userInfo.gmail">
			<P>アカウント名</P>
			<input type="text" v-model="userInfo.name" maxlength="255" required>
			<P>プロフィール</P>
			<textarea rows="3" cols="100" v-model="userInfo.profile" maxlength="1000">
			</textarea>
			<P>アイコン</P>
			<div class="icon">
				<img :src="userPicture" alt="picture">
				<input @change="setFile" type="file" class="button" >
			</div>
			<P>好きな映画</P>
			<input type="text" v-model="userInfo.best" maxlength="255">
			<input @click="updateProfile" type="submit" value="アカウント情報更新" class="button">
		</form>
	</div>
</template>

<style scoped>

.main {
	width: 90%;
	margin: 0 auto;
}
.main p {
	margin: 30px 0 0 0;
}

.icon {
	display: flex;
	justify-content: left;
}
.icon img {
	width: 40%;
	border-radius: 20px;
	margin: 0 5% 0 0;
}
.icon input {
	margin: 450px 0 0 0;
}
@media screen and (max-width:480px) {
	.main form textarea {
		width: 80%;
	}

	.icon {
		display: unset;
	}
	.icon img {
		width: 90%;
	}
	.icon input {
		margin: 50px 0 0 0;
	}
}

.button {
	margin: 0 0 0 2%;
	color: white;
	background-color: black;
	border: solid white 2px;
	border-radius: 10px;
	height: 2.0rem;
}
.button:hover {
	color: black;
	background-color: white;
}

@media screen and (max-width:480px) {
	.button {
		margin: 10px 0 0 2%;
	}
}

</style>

<script>
export default {
  data: function()
	{
		return {
			userInfo: [],
			icon: null,
		}
	},
	props: {
    csrfToken: {
	    type: String,
	    required: false,
    }
	},
	computed: {
		userPicture: function()
		{
			if(this.userInfo.icon == null)
			{
				return '/storage/home/userPotatoImage';
			}
			return '/storage' + this.userInfo.icon.slice(6);
		},
	},
	mounted: function()
		{
			axios.get('/user-info?google_user_gmail=' + this.$route.params.userGmail)
				.then(response => this.userInfo = response.data);
		},
	methods: {
		setFile: function(event) {
			this.icon = event.target.files[0]
		},
		updateProfile: function()
		{
			const formData = new FormData()
			formData.append('gmail', this.userInfo.gmail)
			formData.append('name', this.userInfo.name)
			formData.append('profile', this.userInfo.profile)

			if(this.icon != null)
			{
				formData.append('icon', this.icon)
			}

			formData.append('best', this.userInfo.best)
			const config = {
			headers: {
					'X-CSRF-TOKEN': this.csrfToken,
				}
			}
			
			axios.post('/update', formData, config)
			.then(function(response)
				{
					if(response.data)
					{
						alert("プロフィールが更新されました。")
						location.reload()
					}
					return
				})
			.catch(function(error)
			{
				alert("プロフィールに使用するファイルが画像ファイルでないなどの理由で、プロフィールの更新ができませんでした。")
				return
			})
		}
	}
}
</script>
