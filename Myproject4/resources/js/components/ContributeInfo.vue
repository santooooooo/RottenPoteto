<template>
	<div>
		<p>映画一覧</p>

		<div>
			<p>ジャンル別</p>
			<div v-for="category in categories">
				<input type="radio" :value="category" v-model="genre">{{category}}
			</div>
		</div>

		<div>
			<div v-for="info in contributesInfo">
				<p>タイトル</p>
				<router-link :to="{ path: '/contribute/' + info.id }">{{info.title}}
				</router-link>
				<p>ジャンル</p>
				<p>{{info.genre}}</p>
				<p>満足度</p>
				<p>{{info.satisfaction}}</p>
				<P>オススメ度</P>
				<p>{{info.recommended}}</p>
				<img :src="info.picture" alt="picture">
			</div>
		</div>

	</div>
</template>

<script>

const categories = ['アニメ','アクション','アドベンチャー','S F','コメディ','サスペンス','青春',
	'戦争','ドキュメンタリー','ドラマ','ファンタジー','ホラー','ミュージカル・音楽','恋愛', '指定なし'];

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

				  for(let i = 0; i < this.contributes.length; i++)
				  {
					  if(this.contributes[i].genre == this.genre)
					  {
						  //わざわざオブジェクトの変数と写真のパスの変数を作成したのは、computed特有の環境を保持
						  //し続ける状況でも、常に同じ値を参照し続けるようにするため
						  contribute = this.contributes[i];
						  contributePath = '/storage' + contribute.picture.slice(6);

						  results[i] = {id: contribute.id,title: contribute.title,picture: contributePath,
							  genre: contribute.genre,satisfaction: contribute.satisfaction,
							  recommended: contribute.recommended};
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
						  recommended: contribute.recommended};
			  }
			  return results;
		  }
	  },
   }
</script>
