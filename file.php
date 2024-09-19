<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome To Travel Form</title>
  <link href="index.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <h3>Welcome to the Walton travel group </h3>
    <p>Enter Your Details In This Form...</p>
    <form action="index.php" method="post">
      <!-- Correct action to submit to index.php -->
      <input
        type="text"
        name="name"
        id="name"
        placeholder="Enter Your Name"
        required />
      <input
        type="text"
        name="age"
        id="age"
        placeholder="Enter Your Age"
        required />
      <input
        type="text"
        name="gender"
        id="gender"
        placeholder="Enter Your Gender"
        required />
      <input
        type="number"
        name="class"
        id="class"
        placeholder="Enter Your Class"
        required />
      <input
        type="email"
        name="email"
        id="email"
        placeholder="Enter Your Email"
        required />
      <input
        type="number"
        name="phone"
        id="phone"
        placeholder="Enter Your Phone"
        required />
      <textarea
        name="any_text"
        id="any_text"
        cols="30"
        rows="10"
        placeholder="Enter Any Text"></textarea>
      <button class="btn">Submit</button>
    </form>
  </div>
</body>

</html>