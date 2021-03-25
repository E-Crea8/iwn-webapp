// change order form PDF download
window.onload = function () {
    document.getElementById("downloadChangeOrderFormPDF")
        .addEventListener("click", () => {
            const changeOrderForm = this.document.getElementById("changeOrderForm");
            console.log(changeOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'changeOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(changeOrderForm).set(opt).save();
        })
}
