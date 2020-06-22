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
				<p>{{info.title}}</p>
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

const categories = ['アニメ','アクション','アドベンチャー','SF','コメディ','サスペンス','青春',
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
			axios.get('/top').then(response => this.contributes = response.data)
		},
	  computed: {
		  contributesInfo: function()
		  {
			  let results = [];

			  if(this.genre != '指定なし' && this.genre != null)
			  {
				  for(let i = 0; i < this.contributes.length; i++)
				  {
					  if(this.contributes[i].genre == this.genre)
					  {
						  results[i] = this.contributes[i];
						  //to display pictures on views.
						  results[i].picture = '/storage' + this.contributes[i].picture.slice(6);
					  }
				  }
				  return results;
			  }

			  for(let i = 0; i < this.contributes.length; i++)
			  {
					  //to display pictures on views.
					  results[i] = this.contributes[i];
					  results[i].picture = '/storage' + this.contributes[i].picture.slice(6);
			  }
			  return results;
		  }
	  },
   }
</script>
