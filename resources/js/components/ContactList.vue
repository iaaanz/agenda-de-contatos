<template>
  <div>
    <div class="input-group align-items-center">
      <font-awesome-icon icon="search" class="ms-3" />
      <input
        v-model="search"
        type="text"
        placeholder="Pesquisar"
        class="search_bar form-control bg-white border-0 py-3 m-0"
      >
    </div>
    <v-list>
      <div v-for="contact in contactsList" :key="contact.id">
        <v-list-item two-line>
          <v-list-item-avatar size="50">
            <v-img :src="contact.img_path" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title class="d-flex justify-content-between align-items-center">
              {{ contact.name }}
              <div class="contact-icons">
                <v-btn
                  class="mx-2"
                  fab
                  small
                  elevation="0"
                  color="primary"
                >
                  <font-awesome-icon icon="edit" class="text-white lg" />
                </v-btn>
                <v-btn
                  class="mx-2"
                  fab
                  small
                  elevation="0"
                  color="red"
                  @click="showDelete(contact.id)"
                >
                  <font-awesome-icon icon="trash" class="text-white lg" />
                </v-btn>
              </div>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>
      <DeleteModal v-model="isDeleteVisible" :contact="delContact" @close="showDelete" />
    </v-list>
  </div>
</template>

<script>
import DeleteModal from './Modal/Delete.vue'

export default {
  name: 'ContactList',
  components: { DeleteModal },
  props: {
    contacts: {
      type: Array,
      default: null
    },
  },
  data() {
    return {
      defaultImgUrl: 'img/default_user.png',
      isDeleteVisible: false,
      delContact: null,
      updateContact: null,
      search: '',
    }
  },
  computed: {
    contactsList() {
      if (this.search) {
        return this.contacts.filter(
          contact => contact.name.toLowerCase().includes(this.search.toLowerCase())
        )
      }
      return this.contacts;
    },
  },
  methods: {
    showDelete(id) {
      this.isDeleteVisible = !this.isDeleteVisible;
      this.delContact = id;
    }
  }
}
</script>

<style>
.v-list{
  height: 450px;
  overflow-y: auto;
}
</style>
