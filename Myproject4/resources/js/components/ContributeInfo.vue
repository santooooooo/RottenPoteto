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
				<img :src="info.picture" alt="picture">
				<div class="contribute-text">
					<p>タイトル：<router-link :to="{ path: '/contribute/' + info.id }">{{info.title}}
					</router-link></p>
					<p class="contribute-genre">ジャンル：{{info.genre}}</p>
					<p class="satisfaction">満足度：{{info.satisfaction}}</p>
					<p class="recommended">オススメ度：{{info.recommended}}</P>
				</div>
				<p>{{info.created_at}}</p>
			</div>
		</div>

	</div>
</template>

<style>

h1 {
	margin: 10px 0;
	text-align: center;
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

.contributes {
	width: 95%;
	margin: 0 auto;
	padding: 10px 0;
}
.contribute {
	display: flex;
	justify-content: space-around;
	margin: 50px 0;
}
.contribute img {
	width: 30%;
}
.contribute-text {
	width: 30%;
}
.contribute-genre {
	width: 60%;
	padding: 3px;
	color: black;
	background-color: yellow;
	border-radius: 10px;
	font-weight: 500;
}
.satisfaction {
	width: 30%;
	padding: 3px;
	color: orange;
	border: solid orange 2px;
	border-radius: 10px;
}
.recommended {
	width: 30%;
	padding: 3px;
	color: green;
	border: solid green 2px;
	border-radius: 10px;
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
			axios.get('top').then(response => this.contributes = response.data)
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
