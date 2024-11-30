
function generateSlug(nameInputId, slugInputId) {
        const nameInput = document.getElementById(nameInputId);
        const slugInput = document.getElementById(slugInputId);

        nameInput.addEventListener('input', function() {
            let slug = nameInput.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slugInput.value = slug;
        });
    }
