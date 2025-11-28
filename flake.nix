{
  description = "A universal project flake for Linux and macOS";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    # Use flake-utils to iterate over all common systems (x86_64-linux, aarch64-darwin, etc.)
    flake-utils.lib.eachDefaultSystem (system: let
      # Import nixpkgs for the specific 'system' currently being iterated on
      pkgs = import nixpkgs {
        inherit system;
      };
    in
    # Define the outputs for THIS specific system (e.g., devShells, packages)
    {
      devShells.default = pkgs.mkShell {
        # List common packages that exist on both platforms
        packages = with pkgs; [
          php83
          mysql84
          git
        ];
        shellHook = ''
          PS1='\[\e[1m\e[35m\]\u\[\e[0m\] \[\e[1mat\]\[\e[0m\] \[\e[1m\e[34m\]\h\[\e[0m\] \[\e[1min\]\[\e[0m\] \[\e[1m\e[32m\]\w\[\e[0m\] with nix> '
          PHP_VERSION=$(php -r 'echo phpversion();')
          echo "Welcome to the $system environment!"
          echo "with php version: $PHP_VERSION"
        '';
      };
    });
}

