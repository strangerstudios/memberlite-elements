# Change every instance of memberlite-elements below to match your actual plugin slug
#---------------------------
# This script generates a new pmpro.pot file for use in translations.
# To generate a new memberlite-elements.pot, cd to the main /memberlite-elements/ directory,
# then execute `languages/gettext.sh` from the command line.
# then fix the header info (helps to have the old pmpro.pot open before running script above)
# then execute `cp languages/memberlite-elements.pot languages/memberlite-elements.po` to copy the .pot to .po
# then execute `msgfmt languages/memberlite-elements.po --output-file languages/memberlite-elements.mo` to generate the .mo
#---------------------------
echo "Updating memberlite-elements.pot... "
xgettext -j -o languages/memberlite-elements.pot \
--default-domain=memberlite-elements \
--language=PHP \
--keyword=_ \
--keyword=__ \
--keyword=_e \
--keyword=_ex \
--keyword=_n \
--keyword=_x \
--keyword=esc_html__ \
--keyword=esc_html_e \
--keyword=esc_html_x \
--keyword=esc_attr__ \
--keyword=esc_attr_e \
--keyword=esc_attr_x \
--sort-by-file \
--package-version=1.1 \
--msgid-bugs-address="info@paidmembershipspro.com" \
$(find . -name "*.php")
echo "Done!"