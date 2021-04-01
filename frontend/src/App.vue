<template>
  <div id="app">
      <div v-for="(book, id) of books" :key="id">
        <img :src="`http://localhost:8000/${book.cover}`" alt="" width="100px" height="100px">
        <ul id="list-books">
          <li>{{ book.title }}</li>
          <li>{{ book.genre }}</li>
          <li>{{ book.description }}</li>
          <li>{{ book.sale_price }}</li>
        </ul>
      </div>
  </div>
</template>

<script>
export default {
  name: 'app',

  data() {
    return {
      books: [],
    }
  },

  created() {
    this.$http.get('http://localhost:8000/api/books')
    .then(res => this.books = res.data)
  }

}
</script>

<style>

</style>
