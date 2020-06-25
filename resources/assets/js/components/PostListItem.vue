<template>
  <div class="card shadow-lg my-2">
    <div class="card-header">
      <strong>
        Posted By
        <a :href="'/profiles/' + postData.user.id" class="text-custom">
          {{ postData.user.name }}
        </a>
        {{ formattedCreatedAt }}
      </strong>
      <likes :initial-post-data="initialPostData"></likes>
    </div>
    <div class="card-body">
      <loading :active.sync="isLoading"></loading>

      <div v-if="isEditing">
        <form>
          <div class="form-group">
            <textarea
              id="txtcontent"
              name="txtcontent"
              class="form-control"
              v-model="postData.content"
            ></textarea>
          </div>
          <div class="interaction">
            <a
              href="#"
              class="btn btn-custom btn-sm"
              @click.prevent="update(postData.id)"
            >
              Update
            </a>

            <a
              href="#"
              class="btn btn-danger btn-sm"
              @click.prevent="isEditing = false"
            >
              Cancel
            </a>
          </div>
        </form>
      </div>
      <div v-else>
        <p>{{ postData.content }}</p>
        <div class="interaction" v-if="canUpdate">
          <a
            href="#"
            class="btn btn-custom btn-sm"
            @click.prevent="isEditing = true"
          >
            Edit
          </a>

          <a
            href="#"
            class="btn btn-danger btn-sm"
            @click.prevent="remove(postData.id)"
          >
            Delete
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Likes from './Likes';
import Loading from 'vue-loading-overlay';
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
  props: ['initialPostData'],

  components: {
    Likes,
    Loading
  },

  data() {
    return {
      postData: this.initialPostData,
      isEditing: false,
      isLoading: false
    };
  },

  computed: {
    canUpdate() {
      return this.authorize(user => this.postData.user.id === user.id);
    },

    formattedCreatedAt() {
      let distanceToNow = formatDistanceToNowStrict(
        parseISO(this.postData.created_at)
      );

      return `${distanceToNow} ago`;
    }
  },

  methods: {
    remove(postId) {
      this.isLoading = true;
      axios
        .delete(location.pathname + '/' + postId)
        .then(response => {
          this.$emit('postRemoved');
          this.isLoading = false;
        })
        .catch(error => {
          flashMessage('Error Deleting the Post', 'warning');
          this.isLoading = false;
        });
    },

    update(postId) {
      if (this.content == '') {
        return;
      }
      this.isLoading = true;
      axios
        .put(location.pathname + '/' + postId, {
          content: this.postData.content
        })
        .then(response => {
          this.isEditing = false;
          this.$emit('postUpdated', this.postData.content);
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
