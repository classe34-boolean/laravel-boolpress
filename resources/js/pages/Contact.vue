<template>
  <section class="my-5">
      <h1>Contattaci</h1>

      <div 
        v-show="success"    
        class="alert alert-success">
          Messaggio ricevuto correttamente!
          <br>Ti risponderemo appena possibile.
      </div>

      <form @submit.prevent="sendForm">
          <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" v-model="name" placeholder="Inserisci il tuo nome"
                    :class="{ 'is-invalid': errors.name }"
                >
                <small 
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>
          <div class="form-group">
                <label for="email">Indirizzo Email</label>
                <input type="email" class="form-control" id="email" v-model="email" placeholder="Inserisci il tuo indirizzo e-mail"
                    :class="{ 'is-invalid': errors.email }"
                    >
                <small 
                    v-for="(error, index) in errors.email"
                    :key="`err-email-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>
          <div class="form-group">
                <label for="message">Messaggio</label>
                <textarea class="form-control" id="message" v-model="message" rows="5" placeholder="Inserisci un messaggio di testo"
                    :class="{ 'is-invalid': errors.message }"
                ></textarea>
                <small 
                    v-for="(error, index) in errors.message"
                    :key="`err-message-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>  
          <button 
            class="btn btn-primary" 
            type="submit"
            :disabled="sending">
              {{ sending ? 'Invio in corso...' : 'Invia' }}
          </button>
      </form>
  </section>
</template>

<script>
export default {
    name: 'Contact',
    data: function() {
        return {
            name: '',
            email: '',
            message: '',
            errors: {},
            success: false,
            sending: false
        };
    },
    methods: {
        sendForm: function() {
            this.sending = true;

            axios.post('http://127.0.0.1:8000/api/leads', {
                name: this.name,
                email: this.email,
                message: this.message,
            })
            .then(
                res => {
                    this.sending = false;

                    // console.log(res.data);
                    if(res.data.errors) {
                        // almeno un errore di validazione
                        this.errors = res.data.errors;
                        this.success = false;
                    } else {
                        // lead creato
                        this.errors = {};
                        this.name = '';
                        this.email = '';
                        this.message = '';
                        this.success = true;
                    }
                }
            )
            .catch(
                err => {
                    console.log(err);
                }
            );
        }
    }
}
</script>

<style>

</style>