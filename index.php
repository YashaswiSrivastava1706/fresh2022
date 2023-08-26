<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Website</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
  }
  nav ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    background-color: #444;
  }
  nav li {
    margin: 0 20px;
  }
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
</style>
</head>
<body>
  <header>
    <h1>Fresh 2022 look</h1>
  </header>
  <nav>
    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li>
        <a href="#product">Our Products</a>
        <ul>
          <li><a href="#p1">Product 1</a></li>
          <li><a href="#p2">Product 2</a></li>
          <li><a href="#p3">Product 3</a></li>
          <li><a href="#p4">Product 4</a></li>
        </ul>
      </li>
      <li><a href="#contact">Contact Us</a></li>
    </ul>
  </nav>
  <div class="container" id="content">
    <!-- Content will be dynamically loaded here -->
  </div>
  <script>
    const navbar = [
      { name: 'Home', id: 'home'},
      { name: 'About', id: 'about' },
      { name: 'Our Products', id: 'product', child: [
        { name: 'Product 1', id: 'p1'},
        { name: 'Product 2', id: 'p2' },
        { name: 'Product 3', id: 'p3'},
        { name: 'Product 4', id: 'p4' },
      ] },
      { name: 'Contact Us', id: 'contact'},
    ];

    const contentDiv = document.getElementById('content');
    
    // Function to generate the dynamic navigation menu
    function generateNavMenu() {
      const navList = document.createElement('ul');
      navbar.forEach(item => {
        const listItem = document.createElement('li');
        const link = document.createElement('a');
        link.textContent = item.name;
        link.href = `#${item.id}`;
        listItem.appendChild(link);

        if (item.child) {
          const childList = document.createElement('ul');
          item.child.forEach(childItem => {
            const childListItem = document.createElement('li');
            const childLink = document.createElement('a');
            childLink.textContent = childItem.name;
            childLink.href = `#${childItem.id}`;
            childListItem.appendChild(childLink);
            childList.appendChild(childListItem);
          });
          listItem.appendChild(childList);
        }

        navList.appendChild(listItem);
      });
      document.querySelector('nav ul').appendChild(navList);
    }
    
    async function fetchProducts() {
  try {
    const response = await fetch('proxy.php');
    const data = await response.json();

    if (data && data.products && Array.isArray(data.products)) {
      const productList = document.createElement('ul');
      data.products.forEach(product => {
        const productItem = document.createElement('li');
        productItem.textContent = product.name;
        productList.appendChild(productItem);
      });
      contentDiv.appendChild(productList);
    } else {
      console.error('Invalid API response:', data);
    }
  } catch (error) {
    console.error('Error fetching products:', error);
  }
}

generateNavMenu();
fetchProducts();
  </script>



</body>
</html>