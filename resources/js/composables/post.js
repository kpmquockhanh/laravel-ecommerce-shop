import { computed, ref } from 'vue'
import { useRouter } from "vue-router";
import { doGet } from "./http";
import get from "lodash/get";
export function usePost() {
  const router = useRouter();
  const isLoadingPosts = ref(true);
  const posts = ref([]);
  const pagination = ref({})
  const page = ref(1);

  const paginationPages = computed(() => {
    const numbers = [];
    for (let i = 1; i <= pagination.value.last_page; i++) {
      numbers.push(i)
    }
    return numbers;
  })
  const fetchPosts = async () => {
    const resp = await doGet("/api/posts");
    posts.value = get(resp, "data", []);
    pagination.value = get(resp, "meta", {});
    isLoadingPosts.value = false;
  };

  const fetchPost = async (postId) => {
    const resp = await doGet("/api/posts/" + postId);
    return get(resp, "data", {});
  };


  const fetchRecentPosts = async () => {
    const resp = await doGet("/api/posts/recent_posts");
    posts.value = get(resp, "data", []);
  }

  const goToDetail = async (post) => {
    await router.push({ name: "post_single", params: { slug: post.id } });
  };

  const changePage = async (p) => {
    page.value = p
    isLoadingPosts.value = true;
    const resp = await doGet("/api/posts", { page: page.value });
    posts.value = get(resp, "data", []);
    pagination.value = get(resp, "meta", {});
    isLoadingPosts.value = false;
  };

  return {
    fetchPosts,
    fetchPost,
    fetchRecentPosts,
    posts,
    isLoadingPosts,
    goToDetail,
    pagination,
    paginationPages,
    changePage,
    page,
  };
}
