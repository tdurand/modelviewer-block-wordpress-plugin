# ModelViewer Block WordPress Plugin

This is a custom WordPress block that can be installed in any WordPress instance to display 3D models using the `<model-viewer>` web component.

## Development notes

To run `wp-env` and set up a local WordPress environment, follow these steps:

1. Make sure you have Node.js installed on your machine. You can download it from the official Node.js website.

2. Open your terminal or command prompt and navigate to the root directory of your WordPress project.

3. Install `wp-env` globally by running the following command:

   ```
   npm install -g @wordpress/env
   ```

4. Start the local WordPress environment by running the following command:

   ```
   wp-env start
   ```

   This will download the specified WordPress version, install the plugins and themes, and start a local development server.

5. Access your local WordPress site by opening your web browser and navigating to `http://localhost:8888`. Log into the WordPress dashboard using username `admin` and password `password`.

## Building and installing the WordPress Custom Block

To build the custom WordPress block, follow these steps:``

1. Install the required dependencies:

   ```
   npm install
   ```

2. Build the block:

   ```
   npm run build
   ```

   This will compile the block code and generate the necessary files in the `dist` directory.

3. Copy the generated files to your WordPress plugins directory:

   ```
   cp -R dist /path/to/wordpress/wp-content/plugins/modelviewer-block
   ```

4. Activate the plugin in your WordPress admin panel.

5. You can now use the custom block in the WordPress editor by searching for "Model Viewer Block" in the block inserter.

That's it! You have successfully built and installed the custom WordPress block. Happy coding!
