def isPalindrome(str)
	return str == str.reverse()
end

def reverse(arr)
	return arr.reverse
end

def min(arr)
	return arr.min
end

def max(arr)
	return 0

def contains(arr,e) 
	return arr.index(e).nil? ? false : true
end

def sum(arr)
	sum = 0
	arr.each { |e| sum = sum + e }
	return sum
end

def fib(n)
	memo = Array.new()

	memo[0] = 0
	memo[1] = 1

	2.upto(n) { |i|  memo[i] = memo[i-1] + memo[i-2] }

	return memo[n]
end