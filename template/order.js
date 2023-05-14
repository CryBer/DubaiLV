// Show car details when a car is clicked
function showCarDetails(carId) {
    var modal = document.getElementById("carDetailsModal");
  
    // Fetch car details from the server
    fetch("get_car_details.php?id=" + carId)
      .then(response => response.text())
      .then(data => {
        document.querySelector(".car-details").innerHTML = data;
        modal.style.display = "block";
      })
      .catch(error => console.log(error));
  }
  
  // Show login modal
  function showLoginModal() {
    var modal = document.getElementById("loginModal");
    modal.style.display = "block";
  }
  
  // Close modals when the close button is clicked
  var closeButtons = document.getElementsByClassName("close");
  for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", function() {
      var modal = this.parentElement.parentElement;
      modal.style.display = "none";
    });
  }
// Load cars when the order page is loaded
window.addEventListener('DOMContentLoaded', loadCars);

// Function to load cars from the server
function loadCars() {
  var carList = document.querySelector('.car-list');

  // Fetch car data from the server
  fetch('get_cars.php')
    .then(response => response.json())
    .then(data => {
      // Check if cars exist
      if (data.length > 0) {
        // Generate car items
        var carItems = data.map(car => generateCarItem(car));
        // Append car items to the car list
        carItems.forEach(item => carList.appendChild(item));
      } else {
        // Display message if no cars available
        carList.innerHTML = '<p>No cars available.</p>';
      }
    })
    .catch(error => console.log(error));
}

// Function to generate car item HTML
function generateCarItem(car) {
  var carItem = document.createElement('div');
  carItem.classList.add('car-item');

  var image = document.createElement('img');
  image.src = car.image;
  image.alt = car.make + ' ' + car.model;
  carItem.appendChild(image);

  var heading = document.createElement('h2');
  heading.textContent = car.make + ' ' + car.model;
  carItem.appendChild(heading);

  var description = document.createElement('p');
  description.textContent = car.description;
  carItem.appendChild(description);

  var button = document.createElement('button');
  button.classList.add('order-btn');
  button.textContent = 'View Details';
  button.addEventListener('click', function () {
    showCarDetails(car.id);
  });
  carItem.appendChild(button);

  return carItem;
}
