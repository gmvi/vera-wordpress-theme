DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
ln -s $DIR/theme $1/wp-content/themes/vera 
ln -s $DIR/plugin $1/wp-content/mu-plugins/vera
