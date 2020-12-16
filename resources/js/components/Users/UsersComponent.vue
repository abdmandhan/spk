<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="users"
      class="elevation-1"
      :loading="loading"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Admin</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Admin
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field
                        dense
                        v-model="editedItem.id"
                        label="ID"
                        :error-messages="errors.id"
                        disabled
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12">
                      <v-text-field
                        dense
                        v-model="editedItem.name"
                        label="Name"
                        :error-messages="errors.name"
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12">
                      <v-text-field
                        dense
                        v-model="editedItem.email"
                        label="Email"
                        error-count="2"
                        :error-messages="errors.email"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="headline"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <!-- <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon> -->
      </template>
      <template v-slot:[`item.role`]="{ item }">
        <v-chip color="primary" v-if="item.role">
          {{ item.role }}
        </v-chip>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </div>
</template>


<script>
export default {
  data: () => ({
    selectedUser: "admin",
    loading: true,
    dialog: false,
    dialogDelete: false,
    options: [],
    headers: [],
    users: [],
    errors: [],
    message: "",
    editedIndex: -1,
    editedItem: {
      id: "",
      name: "",
      email: "",
      password: "",
      phone: "",
      address: "",
      role: ""
    },
    defaultItem: {
      id: "",
      name: "",
      email: "",
      password: "",
      phone: "",
      address: "",
      role: ""
    }
  }),
  mounted() {
    this.initialize();
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get(`${this.$baseUrl}/api/user`).then(response => {
        this.users = response.data.data.data;
        this.headers = response.data.data.header;
        this.loading = false;
      });
    },

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      // this.users.splice(this.editedIndex, 1);
      // this.closeDelete();
    },
    close() {
      this.message = "";
      this.errors = [];
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      console.log("EDITED ITEM", this.editedItem);
      axios
        .post(`${this.$baseUrl}/api/user`, this.editedItem)
        .then(response => {
          this.initialize();
          this.close();
          console.log("Response", response);
        })
        .catch(error => {
          this.message = error.response.data.message;
          this.errors = error.response.data.errors;
          console.log("ERROR", error.response, this.message, this.errors);
        });
    }
  }
};
</script>