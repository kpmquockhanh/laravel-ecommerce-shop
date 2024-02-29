<template>
  <section v-if="product?.id" class="section-wrap pb-40 single-product">
    <div class="container-fluid semi-fluid">
      <div class="row">
        <div class="col-md-3 col-xs-12 product-slider">
          <CarouselComponent :items="originImages" ref="myCarousel">
            <template v-slot:default="slotProps">
              <SImage :src="slotProps.item.src" alt="" rounded />
            </template>
          </CarouselComponent>
          <CarouselComponent v-if="!originImages.length" :items="[1]">
            <template>
              <img src="@images/placeholder.jpg" alt="" />
            </template>
          </CarouselComponent>
          <CarouselComponent
            :items="images"
            :number-item="4"
            class="gallery-thumbs"
            item-class="gallery-cell is-selected"
          >
            <template v-slot:default="slotProps">
              <SImage
                :src="slotProps.item.src"
                alt=""
                rounded
                @click="onChangePreview(slotProps.item)"
              />
            </template>
          </CarouselComponent>
        </div>
        <!-- end col img slider -->

        <div class="col-md-9 col-xs-12 product-description-wrap">
          <h1 class="product-title">{{ product.title }}</h1>
          <span class="price">
            <del>
              <span>{{ formatCurrency(product.price * 1.3) }}</span>
            </del>
            <ins>
              <span class="amount">{{
                formatCurrency(product.price * 1)
              }}</span>
            </ins>
          </span>
          <span class="rating">
            <a href="#">3 {{ $t('reviews') }}</a>
          </span>
          <p class="short-description" v-html="product.description"></p>

          <div class="color-swatches clearfix">
            <span>Color:</span>
            <a href="#" class="swatch-violet"></a>
            <a href="#" class="swatch-black"></a>
            <a href="#" class="swatch-cream"></a>
          </div>

          <div class="size-options clearfix">
            <span>Size:</span>
            <a href="#" class="size-xs selected">XS</a>
            <a href="#" class="size-s">S</a>
            <a href="#" class="size-m">M</a>
            <a href="#" class="size-l">L</a>
            <a href="#" class="size-xl">XL</a>
          </div>

          <div class="product-actions">
            <span>Qty:</span>

            <div class="quantity buttons_added">
              <input
                type="number"
                step="1"
                min="0"
                value="1"
                title="Qty"
                class="input-text qty text"
              />
              <div class="quantity-adjust">
                <a href="#" class="plus">
                  <i class="fa fa-angle-up"></i>
                </a>
                <a href="#" class="minus">
                  <i class="fa fa-angle-down"></i>
                </a>
              </div>
            </div>

            <a href="#" class="btn btn-dark btn-lg add-to-cart"
              ><span>{{ $t('add_to_cart') }}</span></a
            >

            <a href="#" class="product-add-to-wishlist"
              ><i class="fa fa-heart"></i
            ></a>
          </div>

          <div class="product_meta">
            <span class="sku">SKU: <a href="#">111763</a></span>
            <span class="brand_as"
              >{{ $t('category') }}: <a href="#">Men T-shirt</a></span
            >
            <span class="posted_in"
              >{{ $t('tags') }}:
              <a href="#">{{
                product.categories?.map((c) => c.name).join(', ')
              }}</a></span
            >
          </div>

          <!-- Accordion -->
          <div class="panel-group accordion mb-50" id="accordion">
            <!--            <div class="panel">-->
            <!--              <div class="panel-heading">-->
            <!--                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="minus">Description<span>&nbsp;</span>-->
            <!--                </a>-->
            <!--              </div>-->
            <!--              <div id="collapseOne" class="panel-collapse collapse in">-->
            <!--                <div class="panel-body">-->
            <!--                  Zenna Theme is a very slick and clean e-commerce template with endless possibilities. Creating an-->
            <!--                  awesome website. Amadea Theme is a very slick and clean e-commerce template with endless-->
            <!--                  possibilities. Creating an awesome website. I would now like to introduce you to your second mind, the-->
            <!--                  hidden and mysterious subconscious.-->
            <!--                </div>-->
            <!--              </div>-->
            <!--            </div>-->

            <div class="panel">
              <div class="panel-heading">
                <a
                  data-toggle="collapse"
                  data-parent="#accordion"
                  href="#collapseTwo"
                  class="plus"
                  >{{ $t('information') }}<span>&nbsp;</span>
                </a>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                  <table class="table shop_attributes">
                    <tbody>
                      <tr>
                        <th>Size:</th>
                        <td>
                          EU 41 (US 8), EU 42 (US 9), EU 43 (US 10), EU 45 (US
                          12)
                        </td>
                      </tr>
                      <tr>
                        <th>Colors:</th>
                        <td>Violet, Black, Blue</td>
                      </tr>
                      <tr>
                        <th>Fabric:</th>
                        <td>Cotton (100%)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-heading">
                <a
                  data-toggle="collapse"
                  data-parent="#accordion"
                  href="#collapseThree"
                  class="plus"
                  >{{ $t('reviews') }}<span>&nbsp;</span>
                </a>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="reviews">
                    <ul class="reviews-list">
                      <li>
                        <div class="review-body">
                          <div class="review-content">
                            <p class="review-author">
                              <strong>Alexander Samokhin</strong> - May 6, 2014
                              at 12:48 pm
                            </p>
                            <div class="rating">
                              <a href="#"></a>
                            </div>
                            <p>
                              This template is so awesome. I didn’t expect so
                              many features inside. E-commerce pages are very
                              useful, you can launch your online store in few
                              seconds. I will rate 5 stars.
                            </p>
                          </div>
                        </div>
                      </li>

                      <li>
                        <div class="review-body">
                          <div class="review-content">
                            <p class="review-author">
                              <strong>Christopher Robins</strong> - May 6, 2014
                              at 12:48 pm
                            </p>
                            <div class="rating">
                              <a href="#"></a>
                            </div>
                            <p>
                              This template is so awesome. I didn’t expect so
                              many features inside. E-commerce pages are very
                              useful, you can launch your online store in few
                              seconds. I will rate 5 stars.
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!--  end reviews -->
                </div>
              </div>
            </div>
          </div>

          <div class="socials-share clearfix">
            <span>{{ $t('share') }}:</span>
            <div class="social-icons nobase">
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-google"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <!-- end col product description -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <ProductRelated v-if="product?.id" :product-id="product.id" />
</template>
<script>
import { computed, onMounted, ref } from 'vue'
import get from 'lodash/get'
import SImage from '../frontend/components/core/Image.vue'
import CarouselComponent from './Carousel.vue'
import ProductRelated from '../frontend/ProductRelated.vue'
import { useProduct } from '../../js/composables/product'
import { formatCurrency } from '../../js/utils'

export default {
  name: 'ProductDetail',
  methods: { formatCurrency },
  components: { ProductRelated, CarouselComponent, SImage },
  setup() {
    const { product, fetchProduct, slug } = useProduct()
    const myCarousel = ref(null)
    const images = computed(() =>
      get(product.value, 'images', []).filter(
        (image) => !image.src.includes('origin')
      )
    )
    const originImages = computed(() =>
      get(product.value, 'images', []).filter(
        (image) => image.src.includes('origin') || image.is_thumbnail
      )
    )
    const onChangePreview = (image) => {
      const split = image.src.split('/')
      const origin = split[split.length - 1]
      const timestamp = origin.split('-')[0]
      const originImageIndex = originImages.value.findIndex(
        (image) => image.src.includes(timestamp) || image.is_thumbnail
      )
      if (originImageIndex > -1 && myCarousel.value) {
        myCarousel.value.slideTo(originImageIndex)
      }
    }
    onMounted(() => {
      fetchProduct()
    })
    return {
      slug,
      product,
      images,
      originImages,
      onChangePreview,
      myCarousel,
    }
  },
}
</script>
