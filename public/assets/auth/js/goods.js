
    document.addEventListener('DOMContentLoaded', function() {
        const agregarBienBtn = document.getElementById('agregar-bien');
        const bienesContainer = document.getElementById('bienes-container');
        
        agregarBienBtn.addEventListener('click', function() {
            const bienDiv = document.createElement('div');
            bienDiv.classList.add('bien');
            
            bienDiv.innerHTML = `
                <label for="description">Descripción del bien:</label>
                <input type="text" name="description[]" class="description">
                
                <label for="cost">Costo del bien:</label>
                <input type="number" name="cost[]" class="cost">
                
                <!-- Otros campos para los bienes -->
            `;
            
            bienesContainer.appendChild(bienDiv);
        });     
    });

