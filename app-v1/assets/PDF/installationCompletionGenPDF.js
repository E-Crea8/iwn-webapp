
// Installation Completion form PDF download
window.onload = function () {
    document.getElementById("downloadInstallationCompletionFormPDF")
        .addEventListener("click", () => {
            const installationCompletionForm = this.document.getElementById("installationCompletionForm");
            console.log(installationCompletionForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'installationCompletionForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(installationCompletionForm).set(opt).save();
        })
}


