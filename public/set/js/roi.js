const services = document.getElementById('services');
function calculateROI() {
    const price = parseFloat(document.getElementById('price').value);
    const quantity = parseFloat(document.getElementById('quantity').value);
    const expenses = parseFloat(document.getElementById('expenses').value);
    const annualPrice = (price * quantity * 12) - expenses;
    const roi = (annualPrice / expenses) * 100;
    
    document.getElementById('annual-price').value = annualPrice.toFixed(2);
    document.getElementById('roi').value = roi.toFixed(2);
  } 