<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section class="jumbotron py-4 border-bottom">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <h1 class="display-6" style="font-weight: bolder;text-align: center;">Welcome to URL Shortener</h1>
                                <p class="lead" style="text-align: center;">Shorten your long URLs with ease</p>
                                <!-- <a href="#how-to-use" class="btn btn-primary btn-lg">Get Started</a> -->
                                <div v-if="showOriginalUrl">
                                    <form @submit.prevent="submitForm">
                                        
                                            <div class="form-group">
                                                <div class="input-group pt-2">
                                                    <input type="text" placeholder="Enter the link here" class="form-control form-control-lg py-3" id="originalUrl" v-model="originalUrl" required>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary btn-lg py-3">Shorten URL</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <blockquote>ShortURL is a free tool to shorten URLs and generate short links URL shortener allows to create a shortened link making it easy to share</blockquote>
                                            </div>
                                        <br>
                                    </form>
                                </div>
                                    
                                <div v-if="shortenedUrl">
                                    
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" v-model="shortenedUrl" class="form-control form-control-lg py-3" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-lg py-3" @click="copyToClipboard" :disabled="isCopied">{{ isCopied ? 'Copied' : 'Copy to Clipboard' }}</button>
                                                    <span class="popover-container">
                                                        <span class="popover-text" v-show="isCopied">Copied!</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <p class="mt-3 text-left">Original URL:
                                        <a :href="originalUrl" target="_blank" class="text-decoration-none">{{ originalUrl }}</a>
                                    </p>
                                    <div class="form-group">
                                        <button v-if="shortenedUrl" class="btn btn-primary" @click="redirectToClickTracking">Total clicks of your shorten URL</button>
                                        <!-- <a :href="trackingUrl" class="btn btn-primary">Total clicks of your shorten URL</a> -->
                                        <br>
                                        <button class="btn btn-primary mt-2" @click="shortenAnotherUrl">Shorten Another URL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="how-to-use" class="py-5">
                    <div class="container">
                        <h2 class="text-center mb-4">How to Use</h2>
                        <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-body">
                                <i class="fas fa-pencil-alt fa-3x mb-3"></i>
                                <h5 class="card-title">Step 1</h5>
                                <p class="card-text">Enter your long URL in the input field</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-body">
                                <i class="fas fa-link fa-3x mb-3"></i>
                                <h5 class="card-title">Step 2</h5>
                                <p class="card-text">Click the "Shorten URL" button</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-body">
                                <i class="fas fa-copy fa-3x mb-3"></i>
                                <h5 class="card-title">Step 3</h5>
                                <p class="card-text">Copy the shortened URL and share it!</p>
                            </div>
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
                originalUrl: '',
                shortenedUrl: '',
                showOriginalUrl: true,
                isCopied: false,
                trackingUrl: ''
            };
        },
        methods: {
            submitForm() {
                axios.post('/urls', { original_url: this.originalUrl })
                    .then(response => {
                        this.shortenedUrl = window.location.origin + '/' + response.data.short_code;
                        this.trackingUrl = window.location.origin + '/urls/' + response.data.short_code+'/track';
                        this.showOriginalUrl = false;

                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            copyToClipboard() {
                const el = document.createElement('textarea');
                el.value = this.shortenedUrl;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);

                this.isCopied = true;
            
                // Hide the "Copied" text and popover after 2 seconds
                setTimeout(() => {
                    this.isCopied = false;
                }, 1000);
            },
            redirectToClickTracking() {
            const shortCode = this.shortenedUrl.split('/').pop();
            this.$router.push({ path: `/urls/${shortCode}/track` });
            },
            shortenAnotherUrl() {
                this.showOriginalUrl = true;
                this.shortenedUrl = '';
                this.originalUrl = '';
            }
        }
    };
</script>
