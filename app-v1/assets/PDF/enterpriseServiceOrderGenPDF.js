
// enterprise service order form PDF download
window.onload = function () {
    document.getElementById("downloadEnterpriseOrderFormPDF")
        .addEventListener("click", () => {
            const enterpriseOrderForm = this.document.getElementById("enterpriseOrderForm");
            console.log(enterpriseOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'enterpriseOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(enterpriseOrderForm).set(opt).save();
        })
}

