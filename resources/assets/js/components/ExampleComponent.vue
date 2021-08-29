<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


<form @submit.prevent="handleSubmit">
<label>Name:</label><br>
<input type="text" required v-model="comment.name">
<br>
<br>
<label>Comment:</label><br>
<textarea type="text" class="comment" required v-model="comment.comment"></textarea>
<br>
<br>
<button> Send Comment! </button>

</form>



<h3>Comments:</h3>





<ul class="list-group"> 

  <li class="list-group-item" v-for="(item,index) in comments" :key="index">
Comment by : {{item.name}}, Says:{{item.children}}
   </li>





  </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      comments: [],
      comment: {name: '', comment:'', father:''}
    };
  },
  created(){
    axios.get('/notas')
    .then(res=>{
      this.comments = res.data;
    })

  },
  methods:
  {
  handleSubmit()
  {

  const params = {name: this.comment.name, text: this.comment.comment}
  console.log(params);

  this.comment.name = '';
  this.comment.comment = '';

  axios.post('/notas',params)
  .then(res => 
  {
    this.comments.unshift(res.data)
  })


      
  }
  }
  }
</script>

