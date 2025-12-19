#!/bin/bash
# URL Replacement Helper for MobileSentrix Header
# This script helps identify URLs that need to be replaced with Laravel helpers

echo "================================"
echo "URL Replacement Analysis"
echo "================================"
echo ""

HEADER_FILE="/Users/mubashirali/Sites/Laravel/mobilesentrix.com/resources/views/components/layout/header-exact.blade.php"

echo "1. MobileSentrix.com URLs found:"
grep -o 'https://www\.mobilesentrix\.com/[^"]*' "$HEADER_FILE" | sort -u | wc -l
echo "   unique URLs need to be replaced with {{ url('/path') }}"
echo ""

echo "2. Static Assets URLs found:"
grep -o 'https://static\.mobilesentrix\.com/[^"]*' "$HEADER_FILE" | sort -u | wc -l
echo "   unique asset URLs need to be replaced with {{ asset('path') }}"
echo ""

echo "3. External URLs (Medium.com, etc.):"
grep -o 'https://[^"]*' "$HEADER_FILE" | grep -v 'mobilesentrix' | sort -u | wc -l
echo "   external URLs (can keep as-is or configure)"
echo ""

echo "================================"
echo "Sample URLs to Replace:"
echo "================================"
echo ""
echo "From www.mobilesentrix.com:"
grep -o 'https://www\.mobilesentrix\.com/[^"]*' "$HEADER_FILE" | sort -u | head -10
echo ""
echo "From static.mobilesentrix.com:"
grep -o 'https://static\.mobilesentrix\.com/[^"]*' "$HEADER_FILE" | sort -u | head -10
echo ""

echo "================================"
echo "To see all URLs, run:"
echo "  grep -o 'https://[^\"]*' $HEADER_FILE | sort -u"
echo "================================"
