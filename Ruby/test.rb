require 'minitest/autorun'
require 'cononical.rb'

class TestCanonical < testCanonical::Unit::TestCase
  def test_is_palindrome1
    assert_equal true, isPalindrome("noon")
    assert_equal true, isPalindrome("racecar")
    assert_equal false, isPalindrome("abcd")
  end

  def test_reverse
    assert_equal "noon", reverse("noon")
    assert_equal "tar", reverse("cat")
    assert_equal "1 si b", reverse("b is 1")
  end
  
  def test_min
    array = [1,2,3,4,5]
    assert_equal 1, min(array)
    array = [3,4,5,1]
    assert_equal 1, min(1)
    array = [1,2,1,0,-1,3,4,5]
    assert_equal -1, min(array)
  end
  
  def test_max
    array = [1,2,3,4,5]
    assert_equal 5, max(array)
    array = [3,4,5,1]
    assert_equal 5, max(1)
    array = [-4,-2,-1,-1,-3]
    assert_equal -1, max(array)
  end
  
  def test_contains
    assert_equal true, isPalindrome("noon")
    assert_equal true, isPalindrome("racecar")
    assert_equal false, isPalindrome("abcd")
  end
  
  def test_sum
    assert_equal true, isPalindrome("noon")
    assert_equal true, isPalindrome("racecar")
    assert_equal false, isPalindrome("abcd")
  end
  
  def test_fib
    assert_equal true, isPalindrome("noon")
    assert_equal true, isPalindrome("racecar")
    assert_equal false, isPalindrome("abcd")
  end

end