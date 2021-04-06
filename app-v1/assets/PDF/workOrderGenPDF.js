
// IP order form PDF download
window.onload = function () {
    document.getElementById("downloadWorkOrderFormPDF")
        .addEventListener("click", () => {
            const workOrderForm = this.document.getElementById("workOrderForm");
            console.log(workOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'workOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(workOrderForm).set(opt).save();
        })
}


