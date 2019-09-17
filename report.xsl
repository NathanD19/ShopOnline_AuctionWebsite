<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<table border="1">
	<tr>
		<th>Item Number</th>
		<th>Item Name</th>
		<th>Category</th>
		<th>Description</th>
		<th>Reserve Price</th>
		<th>Current Bid</th>
		<th>Buy It Now Price</th>
		<th>Start Date</th>
		<th>Start Time</th>
		<th>Status</th>
	</tr>
	<xsl:for-each select="//ListItem[status='SOLD' or status='FAILED']">
	<tr>
		<td><xsl:value-of select="itemId"/></td>
		<td><xsl:value-of select="item"/></td>
		<td><xsl:value-of select="category"/></td>
		<td><xsl:value-of select="desc"/></td>
		<td><xsl:value-of select="rprice"/></td>
		<td><xsl:value-of select="sprice"/></td>
		<td><xsl:value-of select="bprice"/></td>
		<td><xsl:value-of select="startDate"/></td>
		<td><xsl:value-of select="startTime"/></td>
		<td><xsl:value-of select="status"/></td>
	</tr>
	</xsl:for-each>
</table>
		<p>Total of Sold and Failed Items: <xsl:value-of select="count(//ListItem[status='SOLD'])  + count(//ListItem[status='FAILED'])"/></p>
		<p>Revenue from sold items: $<xsl:value-of select=".03*sum(//ListItem[status='SOLD']/sprice)"/></p>
		<p>Revenue from failed items: $<xsl:value-of select=".01*sum(//ListItem[status='FAILED']/rprice)"/></p>
		<p>Total Revenue is: $<xsl:value-of select="(0.03*sum(//ListItem[status='SOLD']/sprice))+(0.01*sum(//ListItem[status='FAILED']/rprice))"/></p>
  </xsl:template>
</xsl:stylesheet>