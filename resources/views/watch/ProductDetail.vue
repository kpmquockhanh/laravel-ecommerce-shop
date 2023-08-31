<template>
    <div>
        <!-- PRODUCT   -->
        <div class="container mt-7">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="row no-gutters">
                        <div class="col-lg-12 d-flex justify-content-center big-product-image">
                            <Image v-if="product.thumbnail" :src="product.thumbnail" rounded class="w-100"/>
                        </div>
                    </div>
                    <div v-if="product?.images?.length > 0" class="row no-gutters">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
                            <div id="thumbs" class="d-flex gap-4">
                                <Image v-if="image?.src" img-class="img-fluid" :src="image.src" rounded class="w-100" v-for="image in product.images"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-3">
                    <h4>{{ product.title }}</h4>
                    <h6 class="font-weight-bold my-2">{{ product.categories?.map(c => c.name).join(', ') }}</h6>
                    <h1>${{ product.price }}</h1>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2 piece-title">PIECE</div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <div class="piece">
                                <button type="button" class="btn piece-btn" onclick="azalt();">-</button>
                                <span id="piece">0</span>
                                <button type="button" class="btn piece-btn" onclick="arttir();">+</button>
                            </div>

                        </div>

                    </div>
                    <div class="d-flex gap-4 flex-column mt-2">
                        <p>
                            <i class="fa fa-check mr-1" aria-hidden="true"></i>
                            Available from stock
                        </p>
                        <p>
                            <i class="fa fa-truck mr-1" aria-hidden="true"></i>
                            Ships out within 2 business days
                        </p>
                        <p>
                            <i class="fa fa-refresh mr-1" aria-hidden="true"></i>
                            Return guarantee
                        </p>
                    </div>
                    <div class="d-flex gap-4 mt-4">
                        <button type="button" class="btn add-to-favorite">ADD TO FAVORİTE</button>
                        <button type="button" class="btn add-to-card">ADD TO CARD</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT END -->

        <!-- DESCRIPTION -->
        <div class="container mt-5">
            <div class="pc-tab">
                <input checked="checked" id="tab1" type="radio" name="pct"/>
                <input id="tab2" type="radio" name="pct"/>
                <input id="tab3" type="radio" name="pct"/>
                <nav>
                    <ul class="d-flex align-items-center gap-4">
                        <li class="tab1">
                            <label for="tab1">Description</label>
                        </li>
                        <li class="tab3">
                            <label for="tab3">Features</label>
                        </li>
                        <li class="tab2">
                            <label for="tab2">Comments</label>
                        </li>
                    </ul>
                </nav>
                <section>
                    <div class="tab1">
                        <p v-html="product.description"></p>
                    </div>
                    <div class="tab2">
                        <div class="comments-card"> <!-- comments-card 1 -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>John Doe</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                        aliquip ex ea
                                        commodo consequat.Duis aute irure.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span class="mr-4"><a href="#"><i class="fa fa-heart-o mr-2" aria-hidden="true"></i></a>Like(5)</span>
                                    <span><a href="#"><i class="fa fa-comment-o mr-2" aria-hidden="true"></i></a>Comment</span>
                                    <span class="comments-date">27.11.2019</span>
                                </div>
                            </div>
                        </div>
                        <div class="comments-card"> <!-- comments-card 2 -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Christopher Lewis</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span class="mr-4"><a href="#"><i class="fa fa-heart-o mr-2" aria-hidden="true"></i></a>Like(2)</span>
                                    <span><a href="#"><i class="fa fa-comment-o mr-2"
                                                         aria-hidden="true"></i></a>Comment(1)</span>
                                    <span class="comments-date">18.11.2019</span>
                                </div>
                            </div>
                        </div>
                        <div class="comments-card-sub"> <!-- comments-card 3 -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Denzel Grant</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat
                                        nulla pariatur.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-8">
                                    <span class="mr-4"><a href="#"><i class="fa fa-heart-o mr-2" aria-hidden="true"></i></a>Like(5)</span>
                                    <span><a href="#"><i class="fa fa-comment-o mr-2" aria-hidden="true"></i></a>Comment</span>
                                    <span class="comments-date">19.11.2019</span>
                                </div>
                            </div>
                        </div>
                        <div class="comments-card"> <!-- comments-card 4 -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Caden Mcfarland</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span class="mr-4"><a href="#"><i class="fa fa-heart-o mr-2" aria-hidden="true"></i></a>Like(1)</span>
                                    <span><a href="#"><i class="fa fa-comment-o mr-2" aria-hidden="true"></i></a>Comment</span>
                                    <span class="comments-date">27.11.2019</span>
                                </div>
                            </div>
                        </div>
                        <!-- new comment -->
                        <div class="container post-a-comment mt-6 p-5">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                    <h4>Post a Comment</h4>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea rows="8" cols="50" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                    <button type="button" class="btn send-button">SEND</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab3">
                        <table>
                            <tr>
                                <td>Width</td>
                                <td class="d-flex justify-content-end">128mm</td>
                            </tr>
                            <tr>
                                <td>Height</td>
                                <td class="d-flex justify-content-end">508mm</td>
                            </tr>
                            <tr>
                                <td>Depth</td>
                                <td class="d-flex justify-content-end">85mm</td>
                            </tr>
                            <tr>
                                <td>Weight</td>
                                <td class="d-flex justify-content-end">52gm</td>
                            </tr>
                            <tr>
                                <td>Quality checking</td>
                                <td class="d-flex justify-content-end">yes</td>
                            </tr>
                            <tr>
                                <td>Freshness Duration</td>
                                <td class="d-flex justify-content-end">3days</td>
                            </tr>
                            <tr>
                                <td>Each Box contains</td>
                                <td class="d-flex justify-content-end">60pcs</td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <!-- DESCRIPTION END  -->

        <!-- SIMILAR PRODUCT SLİDER -->
        <ProductTrend v-if="product.id" type="similar" :product-id="product.id"/>
        <!-- SIMILAR PRODUCT SLİDER END -->
    </div>
</template>
<script>
import {useRoute} from "vue-router";
import ProductTrend from "./components/ProductTrends.vue";
import {computed, ref, watch} from "vue";
import get from "lodash/get";
import Image from "./components/core/Image.vue";
import {doGet} from "../../js/http";

export default {
    name: "ProductDetail",
    components: {Image, ProductTrend},
    setup() {
        const product = ref({});
        const route = useRoute();
        const slug = computed(() => route.params.slug);

        const fetchProduct = async () => {
            if (!slug.value) {
                return
            }
            const resp = await doGet(`/api/products/${slug.value}`)
            product.value = get(resp, 'data', {})
        }
        fetchProduct()
        watch(slug, () => {
            fetchProduct()
        })
        return {
            slug,
            product,
        }

    },
}

</script>

<style scoped>

</style>
