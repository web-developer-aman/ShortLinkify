<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <section class="jumbotron py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                              <h1 class="display-6" style="font-weight: bolder;">Total URL Clicks</h1>
                                <p class="lead">The number of clicks from the shortened URL that redirected the user to the landing page.</p>
                              <div v-if="url">
                                <p>Original URL: <span class="bg-white p-2 rounded" style="line-height: 2.4rem;">{{ url.original_url }}</span></p>
                                <p>Shortened URL: <span class="bg-white p-2 rounded"><a :href="shortenedUrl">{{ shortenedUrl }}</a></span></p>
                                <p><span class="display-6 bg-white py-1 px-4" style="font-weight: bolder;">{{ url.clicks }}</span></p>
                                <button class="btn btn-primary" @click="redirectToShortenForm">Shorten Another URL</button>
                                <!-- <a :href="/" class="btn btn-primary">Shorten Another URL</a> -->
                              </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-primary text-white py-5">
                    <div class="container">
                        <h2 class="text-center mb-4">Why Use URL Shortener?</h2>
                        <p class="lead text-center">URL Shortener offers the following benefits:</p>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Shorten long and complex URLs</li>
                            <li class="list-group-item">Track click statistics for shortened URLs</li>
                            <li class="list-group-item">Improve link sharing on social media platforms</li>
                            <li class="list-group-item">Enhance user experience by reducing URL length</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        url: null
      };
    },
    computed: {
      shortenedUrl() {
        return window.location.origin + '/' + this.$route.params.shortCode;
      }
    },
    mounted() {
      this.fetchUrlDetails();
    },
    methods: {
      fetchUrlDetails() {
        const shortCode = this.$route.params.shortCode;
        // axios.get(`/urls/${shortCode}/track`)
        //   .then(response => {
        //     this.url = response.data;
        //   })
        //   .catch(error => {
        //     console.error(error);
        //   });

          axios.post('/urls/track', { shortCode: shortCode })
            .then(response => {
                this.url = response.data.clicks;
            })
            .catch(error => {
                console.log(error);
            });
      },
      redirectToShortenForm() {
            this.$router.push({ path: `/` });
      }
    }
  };
  </script>
  