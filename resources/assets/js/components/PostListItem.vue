<template>
  <div class="card shadow-lg my-2">
    <div class="card-header">
      <strong>
        Posted By
        <a :href="`/profiles/${post.user.id}`" class="text-custom">
          {{ post.user.name }}
        </a>
        {{ formattedCreatedAt }}
      </strong>
      <post-likes :initial-post-data="initialPost"></post-likes>
    </div>
    <div class="card-body">
      <loading :active.sync="isLoading"></loading>

      <div v-if="isEditing">
        <form @submit.prevent="update">
          <div class="form-group">
            <textarea
              id="txtcontent"
              name="txtcontent"
              class="form-control"
              v-model="post.content"
              required
            ></textarea>
          </div>
          <div class="interaction">
            <button
              type="submit"
              class="btn btn-custom btn-sm"
            >
              Update
            </button>

            <button
              type="button"
              class="btn btn-danger btn-sm"
              @click.prevent="isEditing = false"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
      <div v-else>
        <p>{{ post.content }}</p>
        <div class="interaction" v-if="canUpdate">
          <button
            type="button"
            class="btn btn-custom btn-sm"
            @click.prevent="isEditing = true"
          >
            Edit
          </button>

          <button
            type="button"
            class="btn btn-danger btn-sm"
            @click.prevent="remove"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PostLikes from './PostLikes';
import Loading from 'vue-loading-overlay';
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
  props: ['initialPost'],

  components: {
    PostLikes,
    Loading
  },

  data() {
    return {
      post: this.initialPost,
      isEditing: false,
      isLoading: false
    };
  },

  computed: {
    canUpdate() {
      return this.authorize(user => this.post.user.id === user.id);
    },

    formattedCreatedAt() {
      let distanceToNow = formatDistanceToNowStrict(
        parseISO(this.post.created_at)
      );

      return `${distanceToNow} ago`;
    }
  },

  methods: {
    remove() {
      this.isLoading = true;
      axios
        .delete(`/topics/${this.post.topic_id}/posts/${this.post.id}`)
        .then(response => {
          this.$emit('postRemoved');
          this.isLoading = false;
        })
        .catch(error => {
          flashMessage('Error Deleting the Post', 'warning');
          this.isLoading = false;
        });
    },

    update() {
      this.isLoading = true;

      axios
        .patch(`/topics/${this.post.topic_id}/posts/${this.post.id}` , {
          content: this.post.content
        })
        .then(response => {
          this.isEditing = false;
          this.$emit('postUpdated', this.post.content);
          this.isLoading = false;
        })
        .catch(error => {
          flashMessage('Error Updating the Post', 'warning');
          this.isLoading = false;
        });
    }
  }
};
</script>
