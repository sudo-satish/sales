var mail = function () {
    this.editor;

    this.init = function () {
        // InlineEditor
        ClassicEditor
        // BalloonEditor
            .create( document.querySelector( '#verbose' ),  {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            } )
            .then(editor => {
                this.editor = editor;
            })
            .catch( error => {
                console.error( error );
            } );
    }
    this.simulate = function(mailId) {
        var email = prompt("Please enter your email. Eg.", "");
        var param = prompt("Please enter param. Eg.", "{\"param1\":\"value1\", \"param2\":\"value2\"}");

        // Logic to ajax a test email. 
        if(_.isEmpty(email)) return false;
        if(_.isEmpty(param)) return false;
        axios
            .post('/sys/mail/simulate', {mailId, email, param})
            .then(data => {
                console.log(data);
            })
            .catch(err => console.error(err));
    }
};
