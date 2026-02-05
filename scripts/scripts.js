 // 2. Dropdown Logic
 function updateDropdown(network) {
    const dropdown = document.getElementById('bundle-dropdown');
    dropdown.innerHTML = ''; 
    
    currentNetwork = network.toLowerCase();
    const selectedBundles = allBundles[currentNetwork];
    
    selectedBundles.forEach(bundle => {
        const option = document.createElement('option');
        // We store price in value and use data attributes for bundle size
        option.value = bundle.price_ghs;
        option.setAttribute('data-gb', bundle.bundle_size_gb);
        
        let labelText = `${bundle.bundle_size_gb}GB — GHS ${parseFloat(bundle.price_ghs).toFixed(2)}`;
        if(bundle.label) labelText += ` (${bundle.label})`;
        
        option.textContent = labelText;
        dropdown.appendChild(option);
    });
}

// 3. Network Selection UI
function selectNetwork(element, networkName) {
    const cards = document.querySelectorAll('.network-card');
    cards.forEach(card => {
        card.classList.remove('selected');
        card.classList.add('bg-gray-50', 'border-gray-100');
    });
    
    element.classList.add('selected');
    element.classList.remove('bg-gray-50', 'border-gray-100');
    
    updateDropdown(networkName);
}


// 5. Initialize
window.onload = () => {
    updateDropdown('mtn');
    
    // Attach click listener to your "Buy Now" button
    const buyBtn = document.querySelector('button.bg-blue-600');
    buyBtn.addEventListener('click', payWithPaystack);
};