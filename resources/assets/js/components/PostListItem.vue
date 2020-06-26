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
      <slot></slot>
    </div>
    <div class="card-body">
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
            <button type="submit" class="btn btn-custom btn-sm">
              Update
            </button>

            <button
              type="button"
              class="btn btn-danger btn-sm"
              @click="isEditing = false"
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
            @click="isEditing = true"
          >
            Edit
          </button>

          <button
            type="button"
            class="btn btn-danger btn-sm"
            @click="remove"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
  props: ['initialPost'],

  data() {
    return {
      post: _.cloneDeep(this.initialPost),
      isEditing: false
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
    update() {
      this.isEditing = false;
      this.$emit('update', { ...this.post });
    },

    remove() {
      this.$emit('remove', { ...this.post });
    }
  }
};
</script>
