
public class farmer{

	String name; 
	String farm; 
	String growing_location;
	String market_location; 
	int[] days; 
	String[] products;

	public farmer(String name, String farm, String growing_location, String market_location, int[] days, String[] products)
	{
		this.name=name;
		this.farm=farm;
		this.growing_location=growing_location;
		this.market_location=market_location;
		this.days=days;
		this.products=products;
	}
}
