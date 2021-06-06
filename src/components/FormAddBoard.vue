<!-- Form de Adicionar quadros -->
<template>
  <form>
    <!-- Input do nome do quadro -->
    <ion-item>
      <ion-label position="stacked">Nome do Quadro</ion-label>
      <ion-input
        maxlength="25"
        v-model="board_name"
        inputmode="text"
        placeholder="Insira o nome do Quadro"
        required="true"
      ></ion-input>
    </ion-item>
    <!-- Botão de enviar -->
    <ion-button expand="block" color="primary" @click="save()">
      Salvar
    </ion-button>
  </form>
</template>

<script>
import { IonButton, IonLabel, IonItem, IonInput } from "@ionic/vue";
import { axiosHttp } from "../tools/axios.js";
export default {
  components: {
    IonItem,
    IonButton,
    IonLabel,
    IonInput,
  },
  data() {
    return {
      board_name: "",
    };
  },
  methods: {
    save() {
      if (this.board_name != null) {
        //Função para carregar os quadros da api
        let form = new FormData();
        form.append("board_name", this.board_name);
        axiosHttp
          .post("trosso.php", form, {
            params: { op: "createBoard" },
          })
          .then((resp) => {
            if (resp.data.sucesso) {
              this.$emit("close");
            }
          });
      }
    },
  },
};
</script>

<style scoped>
form {
  padding: 15%;
}
ion-item {
  margin: 30% auto 15% auto;
}

ion-content ion-button {
  margin: 0 auto;
}
</style>
