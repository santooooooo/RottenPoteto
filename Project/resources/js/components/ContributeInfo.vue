<template>
	<div>
		<h1>映画一覧</h1>

		<div class="genre">
			<p>ジャンル</p>
			<div class="category">
				<div v-for="category in categories">
					<input type="radio" :value="category" v-model="genre">{{category}}
				</div>
			</div>
		</div>

		<div class="contributes">
			<div v-for="info in contributesInfo" class="contribute">
				<router-link :to="{ path: '/contribute/' + info.id }"><img :src="info.picture" alt="picture">
				</router-link>
				<div class="contribute-text">
					<p>タイトル：<router-link :to="{ path: '/contribute/' + info.id }">{{info.title}}
					</router-link></p>
					<p>紹介日：{{info.created_at}}</p>
					<p class="contribute-genre">ジャンル：{{info.genre}}</p>
					<p class="satisfaction">満足度：{{info.satisfaction}}</p>
					<p class="recommended">オススメ度：{{info.recommended}}</P>
				</div>
			</div>
		</div>

	</div>
</template>

<style>

h1 {
	margin: 10px 0;
	text-align: center;
}

@media screen and ( max-width:480 ) {
	.genre {
		width: 30%;
	}
}
.genre {
	width: 95%;
	margin: 0 auto;
	border: solid 5px white;
	border-radius: 10px;
}
.genre p {
	margin: 2px 0 0 2px;
}

.category {
	display: flex;
	justify-content: space-between;
	margin: 3px 3px 0 3px;
	color: white;
}
.category div {
	margin: 0 2px 0 0;
}
@media screen and (max-width:480px) {
	.category {
		display: unset;
	}
	.category div {
		margin: 5px 0 0 3%;
	}
}

.contributes {
	width: 90%;
	margin: 0 auto;
	padding: 10px 0;
}
.contribute {
	display: flex;
	justify-content: space-around;
	margin: 50px 0;
}
.contribute a {
	width: 40%;
}
.contribute img {
	width: 100%;
}
.contribute-text {
	width: 30%;
}
.contribute-genre {
	width: 80%;
	padding: 3px;
	color: black;
	background-color: yellow;
	border-radius: 10px;
	font-weight: 500;
}
.satisfaction {
	width: 40%;
	padding: 3px;
	color: orange;
	border: solid orange 2px;
	border-radius: 10px;
}
.recommended {
	width: 40%;
	padding: 3px;
	color: green;
	border: solid green 2px;
	border-radius: 10px;
}
@media screen and (max-width:480px) {
	.contribute {
		display: unset;
		margin: 50px 0;
	}
	.contribute-text {
		width: 100%;
	}
}

</style>

<script>

const categories = ['アニメーション','アクション','アドベンチャー','S F','コメディ','サスペンス',
'青春','戦争','ドキュメンタリー','ドラマ','ファンタジー','ホラー','ミュージカル・音楽','恋愛', 
'指定なし'];

    export default {
    data: function()
    {
	    return {
		    genre: null,
		    categories: categories,
		    contributes: [],
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
			axios.get('/top').then(response => this.contributes = response.data)
		},
	  computed: {
		  contributesInfo: function()
		  {
			  let results = [];
			  let contribute;
			  let contributePath;


			  if(this.genre != '指定なし' && this.genre != null)
			  {
				  let n = 0;

				  for(let i = 0; i < this.contributes.length; i++)
				  {
					  if(this.contributes[i].genre == this.genre)
					  {
						  //わざわざオブジェクトの変数と写真のパスの変数を作成したのは、computed特有の環境を保持
						  //し続ける状況でも、常に同じ値を参照し続けるようにするため
						  contribute = this.contributes[i];
						  contributePath = '/storage' + contribute.picture.slice(6);

						  results[n] = {id: contribute.id,title: contribute.title,picture: contributePath,
							  genre: contribute.genre,satisfaction: contribute.satisfaction,
							  recommended: contribute.recommended, created_at: contribute.created_at.slice(0, 10)};

						  n++;
					  }
				  }
				  return results;
			  }


			  for(let i = 0; i < this.contributes.length; i++)
			  {
						//わざわざオブジェクトの変数と写真のパスの変数を作成したのは、computed特有の環境を保持
						//し続ける状況でも、常に同じ値を参照し続けるようにするため
						contribute = this.contributes[i];
					  contributePath = '/storage' + contribute.picture.slice(6);

					  results[i] = {id: contribute.id,title: contribute.title,picture: contributePath,
						  genre: contribute.genre,satisfaction: contribute.satisfaction,
						  recommended: contribute.recommended, created_at: contribute.created_at.slice(0, 10)};
			  }
			  return results;
		  }
	  },
   }
</script>
